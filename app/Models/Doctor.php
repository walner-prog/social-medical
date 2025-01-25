<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty',
        'city',
        'experience_years',
        'photo',
        'bio',
        'phone',
        'email',
        'availability',
        
        'certifications',    // Nuevos campos
        'education',
        'languages',
        'average_rating',
        'reviews_count',
       // 'linkedin',
      //  'professional_profile',
        'consultation_hours',
       // 'consultation_fee',  // Nuevos campos
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function appointments()
{
    return $this->hasMany(Appointment::class);
}


public function posts()
{
    return $this->hasManyThrough(Post::class, User::class, 'id', 'user_id', 'user_id', 'id');
}




// Total de publicaciones
public function getTotalPostsAttribute()
{
    return $this->posts()->count();
}

// Promedio de rating de los posts
public function getAveragePostRatingAttribute()
{
    return $this->posts()->avg('rating') ?? 0; // Devuelve 0 si no hay calificaciones
}


// categorías en las que el doctor publica más contenido.
public function getMostFrequentCategoryAttribute()
{
    return $this->user->posts()
        ->with('category')
        ->get()
        ->groupBy('category.name')
        ->sortByDesc(fn($posts) => $posts->count())
        ->keys()
        ->first();
}

//Publicación más reciente del doctor 
public function getLatestPostAttribute()
{
    return $this->user->posts()->latest()->first();
}

//cantidad de comentarios acumulados en todos los posts. del doctor
public function getTotalCommentsAttribute()
{
    return $this->user->posts()->withCount('messages')->get()->sum('messages_count');
}

//Porcentaje de publicaciones con alta calificación (e.g., >4 estrellas) 
public function getHighRatingPostsPercentageAttribute()
{
    $totalPosts = $this->user->posts()->count();
    $highRatedPosts = $this->user->posts()->where('rating', '>', 4)->count();

    return $totalPosts > 0 ? round(($highRatedPosts / $totalPosts) * 100, 2) : 0;
}









}
