<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'rating',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // Total de mensajes
    public function getTotalMessagesAttribute()
    {
        return $this->messages()->count();
    }

    // Promedio de calificación
    public function getAverageRatingAttribute()
    {
        return $this->messages()->avg('rating') ?? 0; // Devuelve 0 si no hay calificaciones
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    


}
