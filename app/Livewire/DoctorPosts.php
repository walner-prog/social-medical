<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;

class DoctorPosts extends Component
{
    use WithPagination;

    public $search = '';
    public $categorySearch = '';
    public $perPage = 10;
    public $noResultsMessage = '';
    public $showDeleteModal = false; // Controla si se muestra el modal de confirmación
    public $postToDelete = null; // ID del post que se quiere eliminar
    public $postTitleToConfirm = ''; // Título a confirmar

    protected $updatesQueryString = [
        ['search' => ['except' => '']],
        ['categorySearch' => ['except' => '']],
        ['perPage' => ['except' => 10]],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->categorySearch = '';
    }

    public function searchPosts()
    {
        $this->resetPage(); // Resetea la página al realizar la búsqueda
        $this->noResultsMessage = ''; // Reinicia el mensaje de sin resultados

        // Realizar la búsqueda combinada
        $posts = Post::where('user_id', auth()->id())
            ->when($this->search, function($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->categorySearch, function($query) {
                return $query->whereHas('category', function($query) {
                    $query->where('name', 'like', '%' . $this->categorySearch . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Verificar si no hay resultados
        if ($posts->isEmpty()) {
            $this->noResultsMessage = 'No se encontraron publicaciones con esos criterios.';
        }

        return view('livewire.doctor-posts', [
            'posts' => $posts,
            'categories' => Category::all(),
            'noResultsMessage' => $this->noResultsMessage,
        ]);
    }


    public function render()
    {
        // Filtrado de posts
        $posts = Post::where('user_id', auth()->id())
            ->when($this->search, function($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->categorySearch, function($query) {
                return $query->whereHas('category', function($query) {
                    $query->where('name', 'like', '%' . $this->categorySearch . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.doctor-posts', [
            'posts' => $posts,
            'categories' => Category::all(),
        ]);
    }

   public function confirmDelete($postId)
{
    $post = Post::findOrFail($postId);
    $this->postToDelete = $postId;
    $this->postTitleToConfirm = ''; // Vaciar el campo de título a confirmar
    $this->showDeleteModal = true; // Mostrar el modal
}

public function deletePost()
{
    // Verificar si el título ingresado por el usuario coincide
    if ($this->postTitleToConfirm && $this->postTitleToConfirm == Post::find($this->postToDelete)->title) {
        // El título coincide, proceder a eliminar
        $post = Post::findOrFail($this->postToDelete);
        $post->delete();
        session()->flash('message', 'Publicación eliminada con éxito.');
    } else {
        // Si el título no coincide, mostrar el mensaje correspondiente
        session()->flash('message', 'El título no coincide, no se pudo eliminar la publicación.');
    }

    // Cerrar el modal sin importar si se eliminó o no
    $this->showDeleteModal = false; 
    $this->resetSearch(); // Resetear búsqueda después de la eliminación
}

}
