<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Activity;
class UserObserver
{
    /**
     * Handle the User "created" event.
     */
 
    public function created(User $user)
    {
        Activity::create([
            'activity' => "Nuevo usuario registrado: {$user->name}",
            'date' => now(),
            'status' => 'success',
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
