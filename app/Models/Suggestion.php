<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    /**
     * Especificar la tabla asociada si no es el plural del nombre del modelo.
     */
    protected $table = 'suggestions';
    protected $fillable = ['user_email', 'suggestion',];

   

}
