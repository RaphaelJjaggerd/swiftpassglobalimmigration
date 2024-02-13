<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePlanCoupon extends Model {
  protected $table = 'price_plan_coupons';
  protected $fillable = ['code', 'discount', 'discount_type', 'expire_date', 'status'];
}
