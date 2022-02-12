<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'player';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'lock',
        'ban',
        'luong',
        'coin',
        'ninja',
        'online',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post() {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function doi_coin() {
        return $this->hasMany(DoiCoin::class, 'player_id');
    }

    public function checkout() {
        return $this->hasMany(CheckOut::class, 'player_id');
    }

    public function history_webshop() {
        return $this->hasMany(HistoryWebshop::class, 'player_id');
    }

    public function history_coin() {
        return $this->hasMany(HistoryCoin::class, 'player_id');
    }

    public function history_momo() {
        return $this->hasMany(HistoryMomo::class, 'player_id');
    }

    public function nap_tien() {
        return $this->hasMany(NapTien::class, 'player_id');
    }
}
