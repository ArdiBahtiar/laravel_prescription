<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinePrice extends Model
{
    use HasFactory;

    protected $table = 'medicine_prices';
    protected $fillable = ['id', 'medicine_id', 'unit_price', 'start_date', 'end_date'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
