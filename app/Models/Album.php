<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // Relación muchos a muchos con las imágenes
    public function images()
    {
        return $this->belongsToMany(Image::class, 'album_image')->withTimestamps();
    }
    
    
    
}
