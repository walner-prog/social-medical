<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',  // Relación con el paciente
        'doctor_id',   // Relación con el doctor
         'title', 
         'start', 
         'end',
         'duration',       
        'status' 
    ];

   

    // Relación con el paciente
    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    
    public function getStartAttribute($value) { return Carbon::parse($value); }
    
}
