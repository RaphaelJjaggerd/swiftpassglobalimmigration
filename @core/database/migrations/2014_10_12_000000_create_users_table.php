<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email');
      $table->string('username')->unique();
      $table->string('email_verified')->nullable();
      $table->string('phone')->nullable();
      $table->text('email_verify_token')->nullable();
      $table->text('address')->nullable();
      $table->string('state')->nullable();
      $table->string('city')->nullable();
      $table->string('zipcode')->nullable();
      $table->string('country')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
}
