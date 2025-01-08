<?php


namespace App\Livewire;
use Livewire\Component;
use App\Models\Post;

class PostCounter extends Component
{
    public $postCount;
    public $latestPost;

    // Escuchar el evento 'postCreated'
    protected $listeners = ['post-created' => 'updatePostCount'];

    public function mount()
    {
        $this->postCount = Post::count();
        $this->latestPost = Post::latest()->first();
    }

    public function updatePostCount($data)
    {
        $this->postCount = Post::count();  // Actualiza el contador de publicaciones
        $this->latestPost = Post::latest()->first();  // Obtiene la última publicación
    }

    public function render()
    {
        return view('livewire.post-counter', [
            'postCount' => $this->postCount,
            'latestPost' => $this->latestPost,
        ]);
    }
    
}
