<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'doctor_id'];

    // Relación con el modelo User (un "me gusta" pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Doctor (un "me gusta" pertenece a un doctor)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
