<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryWebshop extends Model
{
    use HasFactory;

    protected $table = 'history_webshop';
    protected $fillable = [
        'player_id',
        'ten_vat_pham',
        'coin',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'player_id');
    }
}
