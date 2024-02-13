<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  protected $table = 'orders';
  protected $fillable = ['status', 'checkout_type', 'user_id', 'payment_status', 'payment_status_2', 'package_payment_type', 'discounted_amount', 'custom_fields', 'attachment', 'package_name', 'package_price', 'package_id'];

  public function package() {
    return $this->hasOne('App\PricePlan', 'id', 'package_id');
  }
  public function user() {
    return $this->hasOne('App\User', 'id', 'user_id');
  }
  public function paymentlog() {
    return $this->hasOne('App\PaymentLogs', 'order_id', 'id');
  }
}
