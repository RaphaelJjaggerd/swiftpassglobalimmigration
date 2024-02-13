@extends('frontend.frontend-page-master')
@section('page-title')
  {{ __('Order Confirm') }}
@endsection

@section('content')
  <div class="error-page-content padding-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="order-confirm-area">
            <h4 class="title">{{ __('Order Details') }}</h4>
            <div class="enroll-form-wrapper">
              <x-error-msg />
              <x-flash-msg />

              <form action="{{ route('frontend.order.payment.form') }}" method="post" enctype="multipart/form-data">
                @csrf
                @php
                  $custom_fields = unserialize($order_details->custom_fields);
                  $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';
                  $name = auth()->check() ? auth()->user()->name : '';
                  $email = auth()->check() ? auth()->user()->email : '';
                @endphp

                <input type="hidden" name="order_id" value="{{ $order_details->id }}">
                <input type="hidden" name="payment_gateway" value="{{ $payment_gateway }}">
                <input type="hidden" name="captcha_token" id="gcaptcha_token">

                <div class="form-group coupon">
                  <label for="coupon">{{ __('Have Coupon?') }}</label>
                  <input type="text" name="coupon" class="form-control" placeholder="{{ __('Coupon') }}">
                  <span class="right spin-none" id="order_coupon_apply">{{ __('Apply') }}<i class="fas fa-spinner fa-spin"></i></span>
                </div>
                <div class="coupon-msg-wrap"></div>

                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td>{{ __('Your Name') }}</td>
                      <td>
                        <div class="form-group">
                          <input type="text" name="name" value="{{ $name }}" class="form-control" placeholder="{{ __('Enter Your Name') }}">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>{{ __('Your Email') }}</td>
                      <td>
                        <div class="form-group">
                          <input type="email" name="email" value="{{ $email }}" class="form-control" placeholder="{{ __('Enter Your Email') }}">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>{{ __('Service Name') }}</td>
                      <td>{{ $order_details->package_name }}</td>
                    </tr>
                    <tr>
                      @if ($package_details->payment_type == 'phased' && $order_details->payment_status == 'pending')
                        <td class="amounts-title">{{ __('Initial Payment') }}</td>
                      @elseif($package_details->payment_type == 'phased' && $order_details->payment_status == 'completed')
                        <td class="amounts-title">{{ __('Final Payment') }}</td>
                      @else
                        <td class="amounts-title">{{ __('Payment') }}</td>
                      @endif

                      <td>
                        @if ($package_details->payment_type == 'phased')
                          <strong class="price">{{ half_amount_with_currency_symbol($order_details->package_price) }}</strong>
                        @else
                          <strong class="price">{{ amount_with_currency_symbol($order_details->package_price) }}</strong>
                        @endif

                        @if (!check_currency_support_by_payment_gateway($payment_gateway))
                          <br>
                          <small>{{ __('You will be charged in ' . get_charge_currency($payment_gateway) . ', you have to pay' . ' ') }}
                            <strong>{{ get_charge_amount($order_details->package_price, $payment_gateway) . get_charge_currency($payment_gateway) }}</strong></small>
                        @endif

                      </td>
                    </tr>
                    <tr>
                      <td>{{ __('Payment Gateway') }}</td>
                      <td class="text-capitalize">
                        @if ($payment_gateway == 'manual_payment')
                          {{ get_static_option('site_manual_payment_name') }}
                        @else
                          {{ $payment_gateway }}
                        @endif
                      </td>
                    </tr>
                    @if ($payment_gateway == 'manual_payment')
                      <tr>

                        <td>
                          <div class="form-group">
                            @if (!empty(get_static_option('manual_payment_gateway')))
                              <div class="label mb-2">{{ __('Attach your bank Document') }}
                              </div>
                              <input class="form-control btn btn-primary btn-sm pb-2" type="file" name="manual_payment_attachment">
                              <span class="help-info mt-2">{!! get_manual_payment_description() !!}</span>
                            @endif

                          </div>
                        </td>
                        <td></td>
                      </tr>
                    @endif

                  </table>
                </div>
                <div class="btn-wrapper">
                  <button type="submit" class="submit-btn style-01">{{ __('Pay Now') }}</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    (function() {
      "use strict";
      $(document).on('click', '#order_coupon_apply', function() {
        var order_id = $('input[name="order_id"]').val();
        var coupon = $('input[name="coupon"]').val();
        $(this).removeClass('spin-none');

        if (coupon == '') {
          $('.coupon-msg-wrap').html('');
          $('.coupon-msg-wrap').html('<span class="text-danger">' + '{{ __('enter coupon') }}' +
            '</span>');
          $(this).addClass('spin-none');
          return;
        }

        $.ajax({
          'type': 'post',
          'url': "{{ route('frontend.course.apply.order.coupon') }}",
          data: {
            '_token': "{{ csrf_token() }}",
            'order_id': order_id,
            'coupon': coupon
          },
          success: function(data) {
            $('#order_coupon_apply').addClass('spin-none');
            $('.coupon-msg-wrap').html('');
            $('.coupon-msg-wrap').html('<span class="text-' + data.status + '">' + data
              .msg + '</span>');

            if (data.status == 'success') {
              var oldPrice = $('.price').text();
              $('.price').html(
                '<span class="discounted-amount" style="color: green; margin-right: 5px;">' +
                data
                .amount +
                '</span><del class="del-old-price" style="color: #888; text-decoration: line-through; opacity: 0.6;">' +
                oldPrice + '</del>');
            }
          }
        });
      });
    })(jQuery);
  </script>
  @if (!empty(get_static_option('site_google_captcha_v3_site_key')) && !empty(get_static_option('site_google_captcha_status')))
    <script src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}"></script>
    <script>
      grecaptcha.ready(function() {
        grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
          action: 'homepage'
        }).then(function(token) {
          document.getElementById('gcaptcha_token').value = token;
        });
      });
    </script>
  @endif
@endsection
