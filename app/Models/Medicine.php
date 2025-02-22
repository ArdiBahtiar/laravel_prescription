<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table = 'medicines';
    protected $fillable = ['id', 'name'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function prices()
    {
        return $this->hasMany(MedicinePrice::class);
    }
}
