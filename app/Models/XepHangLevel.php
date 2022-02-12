<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XepHangLevel extends Model
{
    use HasFactory;

    protected $table = 'xep_hang_level';
    protected $fillable = [
        'ninja_id',
        'name',
        'level',
        'time',
    ];

}
