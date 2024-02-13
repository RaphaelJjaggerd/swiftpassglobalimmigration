<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('appointment_booking_dates', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('appointment_id');
      $table->date('date');
      $table->timestamps();

      // Foreign key constraint to link appointment_id with appointments table
      $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
    });
  }

  public function down() {
    Schema::dropIfExists('appointment_booking_dates');
  }
};
