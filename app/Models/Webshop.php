<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webshop extends Model
{
    use HasFactory;
    
    protected $table = 'webshop';
    protected $fillable = [
        'hinh_anh',
        'ten_vat_pham',
        'chi_tiet_webshop',
        'chi_tiet_game',
        'gia_coin',
    ];

}
