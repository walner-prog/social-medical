<?php

namespace App\Models;

 //use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable   //implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

      

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'registered',
        'google_id',
        'avatar',
        'external_id',
        'external_auth'


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    
    public function isDoctor()
    {
        return $this->doctor !== null;
    }

    public function hasRole($role)
     { 
        return $this->role === $role;
     }


    public function patient()
    {
        return $this->hasOne(Patient::class);
    }


    public function posts()
     { 
        return $this->hasMany(Post::class);
     }

     public function messages() 
     { 
        return $this->hasMany(Message::class); 
    }

    public static function usersPerMonth(): array
    {
        return self::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('count')
            ->toArray();
    }
}
