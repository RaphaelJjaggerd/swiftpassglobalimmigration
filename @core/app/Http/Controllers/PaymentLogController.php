<?php

namespace App\Http\Controllers;

use App\Events;
use App\Events\CourseEnrollSuccess;
use App\Events\JobApplication;
use App\Helpers\PaymentGatewayCredential;
use App\Mail\PlaceOrder;
use App\Order;
use App\PaymentLogs;
use App\PricePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;


class PaymentLogController extends Controller {

  private const SUCCESS_ROUTE = 'frontend.order.payment.success';
  private const CANCEL_ROUTE = 'frontend.order.payment.cancel';
  private const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

  private const EVENT_SUCCESS_ROUTE = 'frontend.event.payment.success';
  private const DONATION_SUCCESS_ROUTE = 'frontend.donation.payment.success';
  private const PRODUCT_SUCCESS_ROUTE = 'frontend.product.payment.success';
  private const APPOINTMENT_SUCCESS_ROUTE = 'frontend.appointment.payment.success';
  private const COURSE_SUCCESS_ROUTE = 'frontend.course.payment.success';
  private const JOB_SUCCESS_ROUTE = 'frontend.job.payment.success';


  public function order_payment_form(Request $request) {

    $this->validate($request, [
      'name' => 'required|string|max:191',
      'email' => 'required|email|max:191',
      'order_id' => 'required|string',
      'payment_gateway' => 'required|string',
    ]);

    if (!get_static_option('disable_guest_mode_for_package_module') && !auth()->guard('web')->check()) {
      return back()->with(['type' => 'warning', 'msg' => __('login to place an order')]);
    }

    $order_details = Order::findOrFail($request->order_id);
    $payment_details = PaymentLogs::where('order_id', $request->order_id)->first();
    $package_details = PricePlan::find($order_details->package_id);




    if (empty($payment_details)) {
      $payment_log_id = PaymentLogs::create([
        'email' => $request->email,
        'name' => $request->name,
        'package_name' => $order_details->package_name,
        'package_price' => $order_details->package_price,
        'package_gateway' => $request->payment_gateway,
        'order_id' => $request->order_id,
        'status' => 'pending',
        'track' => Str::random(10) . Str::random(10),
      ])->id;
      $payment_details = PaymentLogs::findOrFail($payment_log_id);
    }

    if ($request->payment_gateway === 'manual_payment') {

      $this->validate($request, [
        'manual_payment_attachment' => 'required|file'
      ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

      $fileName = time() . '.' . $request->manual_payment_attachment->extension();
      $request->manual_payment_attachment->move('assets/uploads/attachment/', $fileName);

      event(new Events\PackagesOrderSuccess([
        'order_id' =>  $request->order_id,
        'transaction_id' => Str::random(20)
      ]));

      PaymentLogs::where('order_id', $request->order_id)->update(['manual_payment_attachment' => $fileName]);
      $order_id = Str::random(6) . $request->order_id . Str::random(6);
      return redirect()->route('frontend.order.payment.success', $order_id);
    } elseif ($request->payment_gateway === 'stripe') {
      $params = $this->common_charge_customer_data($payment_details, $request, route('frontend.price.plan.stripe.ipn'), $package_details, $order_details);
      $stripe = PaymentGatewayCredential::get_stripe_credential();
      $response = $stripe->charge_customer($params);
      return $response;
    } elseif ($request->payment_gateway === 'paystack') {
      $params = $this->common_charge_customer_data($payment_details, $request, route('frontend.price.plan.paystack.ipn'), $package_details, $order_details);
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


  public function paystack_ipn() {
    $paystack = PaymentGatewayCredential::get_paystack_credential();
    $payment_data = $paystack->ipn_response();
    // return $this->common_ipn_data($payment_data);
    if ($payment_data['type'] == 'price-plan') {
      return $this->common_ipn_data($payment_data);
    } elseif ($payment_data['type'] == 'event') {
      return $this->common_ipn_data_event($payment_data);
    } elseif ($payment_data['type'] == 'donation') {
      return $this->common_ipn_data_donation($payment_data);
    } elseif ($payment_data['type'] == 'product') {
      return $this->common_ipn_data_product($payment_data);
    } elseif ($payment_data['type'] == 'appointment') {
      return $this->common_ipn_data_appointment($payment_data);
    } elseif ($payment_data['type'] == 'course') {
      return $this->common_ipn_data_course($payment_data);
    } elseif ($payment_data['type'] == 'job') {
      return $this->common_ipn_data_job($payment_data);
    }
  }

  private function common_charge_customer_data($payment_details, $request, $ipn_route, $package_details, $order_details, $payment_type = 'price-plan'): array {
    $discounted_amount = $order_details->discounted_amount ?? 0;
    $amount = 0;
    // Calculate the actual amount based on the payment type and discounted amount
    if ($package_details->payment_type == 'phased' && $discounted_amount > 0) {
      $amount = ($payment_details->package_price / 2) - $discounted_amount;
    } elseif ($package_details->payment_type == 'phased') {
      $amount = ($payment_details->package_price / 2);
    } elseif ($discounted_amount > 0) {
      $amount = $payment_details->package_price - $discounted_amount;
    } else {
      $amount = $payment_details->package_price - $discounted_amount;
    }

    $data = [
      'amount' => $amount,
      'title' => __('Payment For service :') . ' ' . $payment_details->id ?? '',
      'description' => 'Payment For Service Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
      'order_id' =>  $payment_details->order_id,
      'track' => $payment_details->track,
      'cancel_url' => route(self::CANCEL_ROUTE, $payment_details->id),
      'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $payment_details->id . random_int(333333, 999999)),
      'email' => $payment_details->email,
      'name' => $payment_details->name,
      'payment_type' => $payment_type,
      'ipn_url' => $ipn_route
    ];

    return $data;
  }



  // private function common_charge_customer_data($payment_details, $request, $ipn_route, $package_details, $payment_type = 'price-plan'): array {
  //   $amount = 0;
  //   if ($package_details->payment_type == 'phased') {
  //     $amount = $payment_details->package_price / 2;
  //   } else {
  //     $amount = $payment_details->package_price;
  //   }
  //   $data = [
  //     'amount' => $amount,
  //     'title' => __('Payment For service :') . ' ' . $payment_details->id ?? '',
  //     'description' => 'Payment For Service Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
  //     'order_id' =>  $payment_details->order_id,
  //     'track' => $payment_details->track,
  //     'cancel_url' => route(self::CANCEL_ROUTE, $payment_details->id),
  //     'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $payment_details->id . random_int(333333, 999999)),
  //     'email' => $payment_details->email,
  //     'name' => $payment_details->name,
  //     'payment_type' => $payment_type,
  //     'ipn_url' => $ipn_route
  //   ];

  //   return $data;
  // }



  //Priceplan Ipn
  private function common_ipn_data($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {

      event(new Events\PackagesOrderSuccess([
        'order_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }

  //Event Ipn for Paystack webhook
  private function common_ipn_data_event($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
      event(new Events\AttendanceBooking([
        'attendance_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::EVENT_SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }

  //Donation Ipn for Paystack webhook
  private function common_ipn_data_donation($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
      event(new Events\DonationSuccess([
        'donation_log_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::DONATION_SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }

  //Product Ipn for Paystack webhook
  private function common_ipn_data_product($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {

      event(new Events\ProductOrders([
        'order_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id']
      ]));

      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::PRODUCT_SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }

  //Appointment Ipn for Paystack webhook
  private function common_ipn_data_appointment($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
      event(new \App\Events\AppointmentBooking([
        'appointment_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::APPOINTMENT_SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }

  //Course Ipn for Paystack webhook
  private function common_ipn_data_course($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
      event(new CourseEnrollSuccess([
        'enroll_id' => $payment_data['order_id'],
        'transaction_id' => $payment_data['transaction_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::COURSE_SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }

  //Job Ipn for Paystack webhook
  private function common_ipn_data_job($payment_data) {
    if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
      event(new JobApplication([
        'transaction_id' => $payment_data['transaction_id'],
        'job_application_id' => $payment_data['order_id'],
      ]));
      $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
      return redirect()->route(self::JOB_SUCCESS_ROUTE, $order_id);
    }
    return redirect()->route(self::STATIC_CANCEL_ROUTE);
  }
}
