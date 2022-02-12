<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'view',
        'image',
        'short_content',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
