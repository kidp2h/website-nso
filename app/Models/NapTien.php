<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NapTien extends Model
{
    use HasFactory;
    protected $table = 'nap_tien';
    protected $fillable = [
        'player_id',
        'type',
        'so_tien',
        'nha_mang',
        'menh_gia',
        'ma_seri',
        'trang_thai',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'player_id');
    }
}
