<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Activity;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        Activity::create([
            'activity' => "Nuevo post creado: {$post->title}",
            'date' => now(),
            'status' => 'success',
        ]);
    }
    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post)
    {
        Activity::create([
            'activity' => "Post actualizado: {$post->title}",
            'date' => now(),
            'status' => 'info',
        ]);
    }


    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post)
    {
        Activity::create([
            'activity' => "Post eliminado: {$post->title}",
            'date' => now(),
            'status' => 'warning',
        ]); 
    }
    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
