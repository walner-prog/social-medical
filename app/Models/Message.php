<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'rating',
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el mensaje padre
    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    // Relación con las respuestas
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
