<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class LatestPosts extends Component
{
    public function render()
    {
        // Obtenemos los 5 últimos posts
        $latestPosts = Post::latest()->take(12)->get();

        return view('livewire.latest-posts', [
            'latestPosts' => $latestPosts,
        ]);
    }
}
