<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckupFile extends Model
{
    protected $table = 'checkup_files';
    public $fillable = ['checkup_id', 'file_path'];
}
