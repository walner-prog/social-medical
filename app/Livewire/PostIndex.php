<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;
use App\Models\Suggestion;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PostIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $search = '';
    public $category = '';
    public $perPage = 9;
    public $tempSearch = '';
    public $tempCategory = '';
    public $suggestion = '';
    public $userEmail;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function updating($property)
    {
        if (in_array($property, ['search', 'category'])) {
            $this->resetPage();
        }
    }

    public function applyFilters()
    {
        $this->search = $this->tempSearch;
        $this->category = $this->tempCategory;
        $this->resetPage();
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->userEmail = Auth::user()->email; // Solo asignar si el usuario está autenticado
        } else {
            $this->userEmail = null; // Asignar un valor nulo si no está autenticado
        }
    
    }

    protected $rules = [
        'suggestion' => 'required|string|max:500',  // Validación de la sugerencia
        'userEmail' => 'required|email',            // Validación del correo
    ];
    // Este método se ejecutará cuando se envíe el formulario
    public function submitSuggestion()
    {
        // Validar los datos del formulario
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para enviar una sugerencia.');
            return;
        }
        $this->validate();

        // Guardar la sugerencia en la base de datos
        Suggestion::create([
            'suggestion' => $this->suggestion,
            'user_email' => $this->userEmail,
        ]);

        // Limpiar el formulario
        $this->reset(['suggestion']);

        // Enviar un mensaje de éxito
        session()->flash('success', '¡Gracias por tu sugerencia!');
    }

    public function render()
    {
        // Obtener los posts según los filtros
        $posts = Post::query()
            ->with('user', 'category', 'messages') // Cargar relaciones necesarias
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Obtener las categorías
        $categories = Category::all();

        // Obtener los posts más populares
        $popularPosts = Post::withCount('messages')
            ->withAvg('messages', 'rating')
            ->orderByDesc(
                DB::raw('(views * 0.5) + (messages_count * 0.3) + (messages_avg_rating * 0.2)')
            )
            ->take(5)
            ->get();

            $events = Event::all();

        return view('livewire.post-index', [
            'posts' => $posts,
            'categories' => $categories,
            'popularPosts' => $popularPosts,
            'events' => $events
         
        ]);
    }
    
}
