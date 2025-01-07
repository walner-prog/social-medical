<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Image extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name', 'filesize', 'path','user_id'
    ];

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_image')->withTimestamps();
    }
    
}
