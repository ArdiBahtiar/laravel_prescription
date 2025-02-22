<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentReceipt extends Model
{
    protected $table = 'payment_receipts';
    public $fillable = ['payment_id', 'file_path'];
}
