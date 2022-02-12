<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryMomo extends Model
{
    use HasFactory;

    protected $table = 'history_momo';
    protected $fillable = [
        'code',
        'player_id',
        'sdt',
        'money',
        'coin',
        'old_coin',
        'new_coin',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'player_id');
    }
}
