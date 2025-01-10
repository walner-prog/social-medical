<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Asegúrate de importar el trait
use App\Models\Category;

class CategoryCard extends Component
{
    use WithPagination; // Habilitamos la paginación
    
    protected $paginationTheme = 'tailwind'; // Usamos el tema tailwind para la paginación

    public function render()
    {
        // Paginamos las categorías con el conteo de posts, obteniendo 15 categorías por página
        $categories = Category::withCount('posts')->paginate(15);

        return view('livewire.category-card', [
            'categories' => $categories, // Pasamos las categorías a la vista
        ]);
    }
}
