<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('price_plan_coupons', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->string('discount')->nullable();
      $table->string('discount_type')->nullable();
      $table->string('expire_date')->nullable();
      $table->string('status')->default('draft');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('price_plan_coupons');
  }
};
