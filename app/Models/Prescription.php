<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';
    public $fillable = ['checkup_id', 'doctor_id', 'status'];
}
