<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Xgenious\Paymentgateway\Base\Gateways\PaystackPay;

class PaymentGatewayCredential {
  // public static function exchange_rate_usd_to_inr(){
  //     return  get_static_option('site_usd_to_inr_exchange_rate') ?? 74;
  // }
  public static function exchange_rate_usd_to_inr() {
    return  get_static_option('site_usd_to_inr_exchange_rate') ?? 74;
  }

  public static function exchange_rate_usd_to_ngn() {
    return  get_static_option('site_usd_to_ngn_exchange_rate') ?? 74;
  }


  //site_inr_to_usd_exchange_rate
  public static function exchange_rate_usd() {
    return  get_static_option('site_' . strtolower(getenv('SITE_GLOBAL_CURRENCY')) . '_to_usd_exchange_rate') ?? 74;
  }
  public static function get_global_currency() {
    return get_static_option('site_global_currency');
  }
  public static function get_paypal_credential(): object {
    $mode = get_static_option('paypal_test_mode') == 'on' ? true : false;

    $paypal_client_id = $mode ? get_static_option('paypal_sandbox_client_id') : get_static_option('paypal_live_client_id');
    $paypal_client_secret = $mode ? get_static_option('paypal_sandbox_client_secret') : get_static_option('paypal_live_client_secret');
    $paypal_app_id = $mode ? get_static_option('paypal_sandbox_app_id') : get_static_option('paypal_live_app_id');
    $paypal = XgPaymentGateway::paypal();
    $paypal->setClientId($paypal_client_id);
    $paypal->setClientSecret($paypal_client_secret);
    $paypal->setAppId($paypal_app_id);
    $paypal->setCurrency(self::get_global_currency());
    $paypal->setEnv($mode);
    $paypal->setExchangeRate(self::exchange_rate_usd());

    return $paypal;
  }



  public static function get_stripe_credential(): object {
    $stripe = XgPaymentGateway::stripe();
    $stripe->setSecretKey(getenv('STRIPE_SECRET_KEY'));
    $stripe->setPublicKey(getenv('STRIPE_PUBLIC_KEY'));
    $stripe->setCurrency(self::get_global_currency());
    $stripe->setEnv(getenv('STRIPE_TEST_MODE'));
    $stripe->setExchangeRate(self::exchange_rate_usd_to_inr());

    return $stripe;
  }



  // public static function get_paystack_credential(): object {
  //   $paystack = XgPaymentGateway::paystack();
  //   $paystack->setPublicKey(getenv('PAYSTACK_PUBLIC_KEY'));
  //   $paystack->setSecretKey(getenv('PAYSTACK_SECRET_KEY'));
  //   $paystack->setMerchantEmail(getenv('MERCHANT_EMAIL'));
  //   $paystack->setCurrency(self::get_global_currency());
  //   $paystack->setEnv(getenv('PAYSTACK_TEST_MODE'));
  //   $paystack->setExchangeRate(self::exchange_rate_usd_to_ngn());

  //   return $paystack;
  // }

  public static function get_paystack_credential(): object {
    $paystackPay = new PaystackPay();
    $paystackPay->setPublicKey(getenv('PAYSTACK_PUBLIC_KEY'));
    $paystackPay->setSecretKey(getenv('PAYSTACK_SECRET_KEY'));
    $paystackPay->setMerchantEmail(getenv('MERCHANT_EMAIL'));
    $paystackPay->setCurrency(self::get_global_currency());
    $paystackPay->setEnv(getenv('PAYSTACK_TEST_MODE'));
    $paystackPay->setExchangeRate(self::exchange_rate_usd_to_ngn());

    return $paystackPay;
  }
}
