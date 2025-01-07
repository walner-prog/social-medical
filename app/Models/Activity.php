<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // Si la tabla tiene un nombre diferente de 'activities', usa esta propiedad
    protected $table = 'activities';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = ['activity', 'date', 'status'];


}
