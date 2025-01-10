<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryPosts extends Component
{
    use WithPagination;

    public $categorySlug;
    public $category;

    // Se declara la cantidad de posts por página
    public $perPage = 15; 

    public function mount($slug)
    {
        $this->categorySlug = $slug;
        $this->loadCategory();
    }

    public function loadCategory()
    {
        $this->category = Category::where('slug', $this->categorySlug)->withCount('posts')->firstOrFail(); 
    }

    public function render()
    {
        $posts = $this->category->posts()->paginate($this->perPage); 

        return view('livewire.category-posts', [
            'category' => $this->category,
            'posts' => $posts,
        ]);
    }
}

