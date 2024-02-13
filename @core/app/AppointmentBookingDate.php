<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentBookingDate extends Model {
  use HasFactory;
  protected $fillable = [
    'appointment_id', 'date',
  ];

  public function appointment() {
    return $this->belongsTo(Appointment::class);
  }
}
