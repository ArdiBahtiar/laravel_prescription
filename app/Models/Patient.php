<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    public $fillable = ['name', 'birth_date', 'gender', 'address', 'phone'];
}
