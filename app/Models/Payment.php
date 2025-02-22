<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    public $fillable = ['prescription_id', 'apoteker_id', 'total_price', 'payment_date', 'file_path'];
}
