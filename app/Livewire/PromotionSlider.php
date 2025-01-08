<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Promotion;
use App\Models\Post; // Importar el modelo Post

class PromotionSlider extends Component
{
    public $promotions;
    public $posts; // Propiedad para los posts

    public function mount()
    {
        $this->promotions = Promotion::where('end_date', '>', now())->get();
        $this->posts = Post::latest()->take(4)->get(); // Obtener los últimos 4 posts
    }

    public function render()
    {
        return view('livewire.promotion-slider');
    }
}
