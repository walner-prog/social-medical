<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['doctor_id', 'user_id','post_id', 'rating', 'review'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post() { return $this->belongsTo(Post::class); }
}
