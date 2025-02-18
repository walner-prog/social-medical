<?php

namespace App\Providers;

//use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Post;
use App\Models\Doctor;
use App\Observers\UserObserver;
use App\Observers\PostObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Gate::before(function ($user, $ability) {
            return $user->hasRole('doctor') ? true : null;
        });

        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);

        // Definimos un Gate para actualizar el doctor
        Gate::define('update-doctor', function (User $user, Doctor $doctor) {
        return $user->id === $doctor->user_id;  // Compara si el usuario autenticado es el dueño del doctor
        });
        
    }
}
