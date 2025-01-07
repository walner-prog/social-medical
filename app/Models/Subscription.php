<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    // permite guardar datos masivamente 

    protected $fillable = [
        'user_id',
        'plan',
        'amount',
        'start_date',
        'end_date',
       ];

    // Subscription.php
public function user() {
    return $this->belongsTo(User::class);
}

}
