<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicine extends Model
{
    protected $table = 'prescription_medicines';
    public $fillable = ['prescription_id', 'medicine_id', 'quantity', 'price'];
}
