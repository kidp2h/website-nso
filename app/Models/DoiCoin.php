<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoiCoin extends Model
{
    use HasFactory;

    protected $table = 'doi_coin';
    protected $fillable = [
        'player_id',
        'coin',
        'old_coin',
        'new_coin',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'player_id');
    }
}
