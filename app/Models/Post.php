<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = [
        'content',
        'imagem_url',
        'video_url',
        'views_count',
        'likes_count',
        'favorites_count',
        'status',
        'is_subscriber_only',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
