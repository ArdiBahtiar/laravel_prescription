<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    protected $table = 'checkups';
    public $fillable = ['patient_id', 'doctor_id', 'checkup_date', 'height', 'weight', 'systole', 'diastole', 'heart_rate', 'respiration_rate', 'temperature', 'diagnosis'];
}
