<?php

namespace App\Models;
use HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Patient extends Model
{
  
    use  Notifiable;
    protected $fillable = [
        'user_id',
        'name',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
{
    return $this->hasMany(Appointment::class);
}

}
