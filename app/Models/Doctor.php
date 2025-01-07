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



}
