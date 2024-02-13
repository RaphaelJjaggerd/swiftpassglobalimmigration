<?php

namespace App\Http\Controllers\Frontend;

use DateInterval;
use App\Appointment;
use App\PaymentLogs;
use App\CourseCoupon;
use App\Mail\BasicMail;
use App\AppointmentBooking;
use Illuminate\Support\Str;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Facades\EmailTemplate;
use App\AppointmentBookingTime;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Helpers\PaymentGatewayCredential;
use Stevebauman\Location\Facades\Location;
use App\Http\Controllers\UserLocationController;
use KingFlamez\Rave\Facades\Rave as Flutterwave;



class AppointmentBookingController extends Controller {

  const SUCCESS_ROUTE = 'frontend.appointment.payment.success';
  const CANCEL_ROUTE = 'frontend.appointment.payment.cancel';
  const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

  private function isCouponValid($coupon_details) {
    // Add your validation logic here, e.g., check expiration date, usage limits, etc.
    return $coupon_details->expire_date >= now();
  }

  // Helper function to calculate discounted amount based on coupon details
  private function calculateDiscountedAmount($coupon_details, $total) {
    $discounted_amount = 0;

    if ($coupon_details->discount_type === 'percentage') {
      $discount_bal = ($total / 100) * (int) $coupon_details->discount;
      $discounted_amount = $total - $discount_bal;
    } elseif ($coupon_details->discount_type === 'amount') {
      $discounted_amount = $total - (int) $coupon_details->discount;
    }

    return $discounted_amount;
  }
  public function booking(Request $request) {

    $this->validate($request, [
      'name' => 'required|string|max:191',
      'booking_date' => 'required|string|max:191',
      'appointment_id' => 'required|string|max:191',
      'booking_time_id' => 'required|string|max:191',
      'email' => 'required|email|max:191',
    ], [
      'name.required' => __('name is required'),
      'email.required' => __('email is required'),
      'booking_date.required' => __('select date'),
      'booking_time_id.required' => __('select time'),
    ]);
    if (!get_static_option('disable_guest_mode_for_appointment_module') && !auth()->guard('web')->check()) {
      return back()->with(['type' => 'warning', 'msg' => __('login to place an order')]);
    }
    $appointment = Appointment::findOrFail($request->appointment_id);
    $max_appointment = AppointmentBooking::where(['appointment_id' => $appointment->id, 'booking_date' => date('d-m-y')])->count();

    if ($max_appointment >= $appointment->max_appointment) {
      $data['type'] = 'danger';
      $data['msg'] = __('no more appointments available for today');
      return back()->with($data);
    }


    if (empty($request->booking_id)) {

      //check custom field validation
      $validated_data = $this->get_filtered_data_from_request(get_static_option('appointment_booking_page_form_fields'), $request);
      $all_attachment = $validated_data['all_attachment'];
      $all_field_serialize_data = $validated_data['field_data'];
      unset($all_field_serialize_data['captcha_token']);
      unset($all_field_serialize_data['transaction_id']);
      $booking_time = AppointmentBookingTime::find($all_field_serialize_data['booking_time_id']);
      $all_field_serialize_data['booking_time'] = $booking_time ? $booking_time->time : __('no time slot selected');
      unset($all_field_serialize_data['booking_time_id']);

      if (empty($request->selected_payment_gateway)) {
        unset($all_field_serialize_data['payment_gateway']);
      }
      //save content to database
      $payment_status = 'pending';
      $booking_status = 'pending';
      if ($appointment->price === 0 || empty($appointment->price)) {

        $payment_status = 'complete';
        $booking_status = 'complete';
      }



      $total = 0;
      $allowedCountries = ['Kenya', 'Ghana', 'South Africa'];
      $user = auth()->user();
      $userLocation = $user->country;

      // Fetch user location using UserLocationController
      // $locationController = new UserLocationController();
      // $userLocation = $locationController->getUserInfo($request);


      // Check if the user has paid for a package  in the last 30 days
      $lastPackagePayment = PaymentLogs::where('email', $request->email)
        ->where('created_at', '>=', now()->sub(new DateInterval('P30D')))
        ->where('status', 'complete')
        ->first();

      // Check if the user has paid for an appointment in the last 30 days
      $lastAppointmentPayment = AppointmentBooking::where('email', $request->email)
        ->where('created_at', '>=', now()->sub(new DateInterval('P30D')))
        ->where('status', 'complete')
        ->where('total', '>', 0)
        ->first();

      if ($lastPackagePayment || $lastAppointmentPayment) {
        // User has paid in the last 30 days, set total to 0
        $new_appointment =  AppointmentBooking::create([
          'custom_fields' => $all_field_serialize_data,
          'all_attachment' => $all_attachment,
          'email' =>  $request->email,
          'name' => $request->name,
          'total' => 0,
          'appointment_id' => $appointment->id,
          'user_id' => auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null,
          'payment_gateway' => $request->selected_payment_gateway ?? '',
          'payment_track' => Str::random(10) . Str::random(10),
          'transaction_id' => null,
          'payment_status' => 'complete',
          'booking_date' => $request->booking_date,
          'booking_time_id' => $request->booking_time_id,
          'status' => 'complete',
          'appointment_type' => $request->appointment_type,
        ]);
        $order_id = Str::random(6) . $new_appointment->id . Str::random(6);
        return redirect()->route(self::SUCCESS_ROUTE, $order_id);
      } else {
        if ($request->appointment_type == 'virtual') {
          // Check if the user's location is Kenya, Ghana, or South Africa
          if (in_array($userLocation, $allowedCountries)) {
            $total = 50; // Charge $50 for users from allowed countries
          } else {
            $total = 85; // Charge $85 for users from other countries
          }
        } elseif ($request->appointment_type == 'on_premise') {
          $total = $appointment->price;
        }
      }


      // Check if a coupon code is provided
      if (!empty($request->coupon)) {
        // Validate and apply the coupon
        $coupon_details = CourseCoupon::where('code', $request->coupon)->first();

        if (!$coupon_details || !$this->isCouponValid($coupon_details)) {
          // Coupon is invalid or expired, redirect with a message
          $data['type'] = 'danger';
          $data['msg'] = __('Invalid or expired coupon code');
          return back()->with($data);
        }

        // Apply the coupon discount to the total
        $discounted_amount = $this->calculateDiscountedAmount($coupon_details, $total);
        $total = $discounted_amount > 0 ? $discounted_amount : $total;
      }

      // Log::info('Total Variable Value:', ['total' => $total]);


      $new_appointment =  AppointmentBooking::create([
        'custom_fields' => $all_field_serialize_data,
        'all_attachment' => $all_attachment,
        'email' =>  $request->email,
        'name' => $request->name,
        'total' => $total,
        'appointment_id' => $appointment->id,
        'user_id' => auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null,
        'payment_gateway' => $request->selected_payment_gateway ?? '',
        'payment_track' => Str::random(10) . Str::random(10),
        'transaction_id' => null,
        'payment_status' => $payment_status,
        'booking_date' => $request->booking_date,
        'booking_time_id' => $request->booking_time_id,
        'status' => $booking_status,
        'appointment_type' => $request->appointment_type,
      ]);
    } else {
      $new_appointment = AppointmentBooking::findOrFail($request->booking_id);
    }

    if (empty(get_static_option('site_payment_gateway'))) {
      //todo add filter if client disabled all payment gateway
      event(new \App\Events\AppointmentBooking([
        'appointment_id' =>  $new_appointment->id,
        'transaction_id' => Str::random(20)
      ]));


      $order_id = Str::random(6) . $new_appointment->id . Str::random(6);
      return redirect()->route(self::SUCCESS_ROUTE, $order_id);
    }

    if ($request->selected_payment_gateway === 'paypal') {
      $params = $this->common_charge_customer_data($new_appointment, route('frontend.appointment.paypal.ipn'));
      $paypal = PaymentGatewayCredential::get_paypal_credential();
      $response = $paypal->charge_customer($params);
      return $response;
    } elseif ($request->selected_payment_gateway === 'manual_payment') {

      $this->validate($request, [
        'manual_payment_attachment' => 'required|file'
      ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

      $fileName = time() . '.' . $request->manual_payment_attachment->extension();
      $request->manual_payment_attachment->move('assets/uploads/attachment/', $fileName);

      event(new \App\Events\AppointmentBooking([
        'appointment_id' =>  $new_appointment->id,
        'transaction_id' => Str::random(20)
      ]));

      AppointmentBooking::where('id', $new_appointment->id)->update(['manual_payment_attachment' => $fileName]);
      $order_id = Str::random(6) . $new_appointment->id . Str::random(6);
      return redirect()->route(self::SUCCESS_ROUTE, $order_id);
    } elseif ($request->selected_payment_gateway === 'stripe') {
      $params = $this->common_charge_customer_data($new_appointment, route('frontend.appointment.stripe.ipn'));
      $stripe = PaymentGatewayCredential::get_stripe_credential();
      $response = $stripe->charge_customer($params);
      return $response;
    } elseif ($request->selected_payment_gateway === 'paystack') {
      $params = $this->common_charge_customer_data($new_appointment, route('frontend.price.plan.paystack.ipn'));
      $paystack = PaymentGatewayCredential::get_paystack_credential();
      $response = $paystack->charge_customer($params);
      return $response;
    }

    return redirect()->route('homepage');
  }



  public function paypal_ipn() {
    $paypal = PaymentGatewayCredential::get_paypal_credential();
    $payment_data = $paypal->ipn_response();
    return $this->common_ipn_data($payment_data);
  }



  public function stripe_ipn() {
    $stripe = PaymentGatewayCredential::get_stripe_credential();
    $payment_data = $stripe->ipn_response();
    return $this->common_ipn_data($payment_data);
  }



  public function get_filtered_data_from_request($option_value, $request) {

    $all_attachment = [];
    $all_quote_form_fields = (array) json_decode($option_value);
    $all_field_type = isset($all_quote_form_fields['field_type']) ? (array) $all_quote_form_fields['field_type'] : [];
    $all_field_name = isset($all_quote_form_fields['field_name']) ? $all_quote_form_fields['field_name'] : [];
    $all_field_required = isset($all_quote_form_fields['field_required'])  ? (object) $all_quote_form_fields['field_required'] : [];
    $all_field_mimes_type = isset($all_quote_form_fields['mimes_type']) ? (object) $all_quote_form_fields['mimes_type'] : [];

    //get field details from, form request
    $all_field_serialize_data = $request->all();
    unset($all_field_serialize_data['_token']);
    if (isset($all_field_serialize_data['captcha_token'])) {
      unset($all_field_serialize_data['captcha_token']);
    }


    if (!empty($all_field_name)) {
      foreach ($all_field_name as $index => $field) {
        $is_required = !empty($all_field_required) && property_exists($all_field_required, $index) ? $all_field_required->$index : '';
        $mime_type = !empty($all_field_mimes_type) && property_exists($all_field_mimes_type, $index) ? $all_field_mimes_type->$index : '';
        $field_type = isset($all_field_type[$index]) ? $all_field_type[$index] : '';
        if (!empty($field_type) && $field_type == 'file') {
          unset($all_field_serialize_data[$field]);
        }
        $validation_rules = !empty($is_required) ? 'required|' : '';
        $validation_rules .= !empty($mime_type) ? $mime_type : '';

        //validate field
        $this->validate($request, [
          $field => $validation_rules
        ]);

        if ($field_type == 'file' && $request->hasFile($field)) {
          $filed_instance = $request->file($field);
          $file_extenstion = $filed_instance->getClientOriginalExtension();
          $attachment_name = 'attachment-' . Str::random(32) . '-' . $field . '.' . $file_extenstion;
          $filed_instance->move('assets/uploads/attachment/applicant', $attachment_name);
          $all_attachment[$field] = 'assets/uploads/attachment/applicant/' . $attachment_name;
        }
      }
    }
    return [
      'all_attachment' => $all_attachment,
      'field_data' => $all_field_serialize_data
    ];
  }

  private function common_charge_customer_data($booking_details, $ipn_route, $payment_type = 'appointment'): array {
    $data = [
      'amount' => $booking_details->total,
      'title' => __('Payment For Appointment Booking Id:') . ' #' . $booking_details->id,
      'description' => __('Payment For Appointment Booking Id:') . ' #' . $booking_details->id . ' ' . __('Payer Name: ') . ' ' . $booking_details->name . ' ' . __('Payer Email:') . ' ' . $booking_details->email,
      'order_id' => $booking_details->id,
      'track' => $booking_details->payment_track,
      'cancel_url' => route(self::CANCEL_ROUTE, $booking_details->id),
      'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $booking_details->id . random_int(333333, 999999)),
      'email' => $booking_details->email,
      'name' => $booking_details->name,
      'payment_type' => $payment_type,
      'ipn_url' => $ipn_route
    ];
    return $data;
  }

  private function common_ipn_data($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
      event(new \App\Events\AppointmentBooking([
        'appointment_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }
}
