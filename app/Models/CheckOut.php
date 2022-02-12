<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table = 'checkout';
    protected $fillable = [
        'player_id',
        'label',
        'address',
        'dogecoin',
        'money',
        'status',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'player_id');
    }
}
