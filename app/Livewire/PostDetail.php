<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Message;
use Livewire\WithPagination;
\Carbon\Carbon::setLocale('es');


class PostDetail extends Component
{
    use WithPagination;

    public $post;
    public $comments = [];
    public $commentsPerPage = 3;
    public $commentsOffset = 0;
    public $content;
    public $rating;
    public $user;
    public $relatedPosts;
    public $parentId;
  

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->user = auth()->user();

        $this->loadComments();

        // Cargar posts relacionados por categoría
        $this->relatedPosts = Post::where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->take(10)
            ->get();

       

    }
    

    public function loadComments()
{
    $this->comments = $this->post->messages()
        ->with(['user', 'replies.user']) // Incluye usuario y respuestas
        ->latest()
        ->offset($this->commentsOffset)
        ->limit($this->commentsPerPage)
        ->get();
}


    public function loadMoreComments()
    {
        $this->commentsOffset += $this->commentsPerPage;

        $additionalComments = $this->post->messages()
            ->with('user')
            ->latest()
            ->offset($this->commentsOffset)
            ->limit($this->commentsPerPage)
            ->get();

        $this->comments = $this->comments->merge($additionalComments); // Mantén las relaciones
    }

    public function submitReview()
    {
        // Validar los datos
        $this->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Crear la reseña (Message)
        Message::create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'content' => $this->content,
            'rating' => $this->rating,
        ]);

        // Actualizar la calificación promedio del post
        $this->post->rating = $this->post->messages()->avg('rating');
        $this->post->save();

         // Recargar los comentarios para que el nuevo aparezca
        $this->loadComments();

        // Limpiar campos
        $this->content = '';
        $this->rating = null;

        session()->flash('message', 'Reseña enviada con éxito.');
    }



    public function render()
    {
             // Obtenemos los 5 últimos posts
        $latestPosts = Post::latest()->take(12)->get();
        return view('livewire.post-detail', [
            'post' => $this->post,
            'relatedPosts' => $this->relatedPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}


/*

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Message;
use Livewire\WithPagination;
\Carbon\Carbon::setLocale('es');


class PostDetail extends Component
{
    use WithPagination;

    public $post;
    public $comments = [];
    public $commentsPerPage = 3;
    public $commentsOffset = 0;
    public $content;
    public $rating;
    public $user;
    public $relatedPosts;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->user = auth()->user();

        $this->loadComments();

        // Cargar posts relacionados por categoría
        $this->relatedPosts = Post::where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->take(5)
            ->get();
    }

    public function loadComments()
    {
        $this->comments = $this->post->messages()
            ->with('user') // Relaciona el usuario que envió el comentario
            ->latest()
            ->offset($this->commentsOffset)
            ->limit($this->commentsPerPage)
            ->get();
    }

    public function loadMoreComments()
    {
        $this->commentsOffset += $this->commentsPerPage;

        $additionalComments = $this->post->messages()
            ->with('user')
            ->latest()
            ->offset($this->commentsOffset)
            ->limit($this->commentsPerPage)
            ->get();

        $this->comments = $this->comments->merge($additionalComments); // Mantén las relaciones
    }

    public function submitReview()
    {
        // Validar los datos
        $this->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Crear la reseña (Message)
        Message::create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'content' => $this->content,
            'rating' => $this->rating,
        ]);

        // Actualizar la calificación promedio del post
        $this->post->rating = $this->post->messages()->avg('rating');
        $this->post->save();

         // Recargar los comentarios para que el nuevo aparezca
        $this->loadComments();

        // Limpiar campos
        $this->content = '';
        $this->rating = null;

        session()->flash('message', 'Reseña enviada con éxito.');
    }

    public function render()
    {
        return view('livewire.post-detail', [
            'post' => $this->post,
            'relatedPosts' => $this->relatedPosts,
        ]);
    }
}


*/