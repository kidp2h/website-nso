<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCoin extends Model
{
    use HasFactory;

    protected $table = 'history_coin';
    protected $fillable = [
        'player_id',
        'coin',
        'old_coin',
        'new_coin',
        'desc',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'player_id');
    }

}
