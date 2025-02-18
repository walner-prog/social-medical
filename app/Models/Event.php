<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Event extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id', 'title', 'start', 'end', 'description', 'location', 'hour', 'cost', 'audience', 'registration'
    ];
    



    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
