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
    Schema::table('orders', function (Blueprint $table) {
      $table->string('package_payment_type')->nullable(); // Adjust the data type and other attributes as needed
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('orders', function (Blueprint $table) {
      $table->dropColumn('package_payment_type');
    });
  }
};
