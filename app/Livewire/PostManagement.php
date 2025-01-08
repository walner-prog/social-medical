<?php

namespace App\Livewire;

use Livewire\Component;
 use Livewire\WithFileUploads;
 use App\Models\Post;
 use App\Models\Category;
 use Illuminate\Support\Str;
 use HTMLPurifier;
use HTMLPurifier_Config;
class PostManagement extends Component
{
    use WithFileUploads;

    public $postId;
    public $title;
    public $content;
    public $image;
    public $category_id;
    public $imagePreview;
    public $existingImage;
    public $isEditing = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048', // Max image size 2MB
        'category_id' => 'required|exists:categories,id',
    ];

    public function mount($postId = null)
    {
        if ($postId) {
            $this->isEditing = true;
            $post = Post::findOrFail($postId);
            $this->postId = $post->id;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->category_id = $post->category_id;
            $this->existingImage = $post->image;
        }
    }

    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }
    public function savePost()
    {
        $this->validate();
    
        $imagePath = $this->existingImage;
    
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public'); // Store image in 'public/images' directory
        }
    
        // Limpiar el contenido con HTMLPurifier
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $cleanContent = $purifier->purify($this->content); // Esto elimina las etiquetas maliciosas pero conserva lo necesario
    
        if ($this->isEditing) {
            $post = Post::findOrFail($this->postId);
            $post->update([
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'content' => $cleanContent, // Guardar contenido limpio
                'image' => $imagePath,
                'category_id' => $this->category_id,
            ]);
    
            // Emitir el evento para actualizar el contador usando el post actualizado
            $this->dispatch('post-created', ['title' => $post->title]);
        } else {
            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'content' => $cleanContent, // Guardar contenido limpio
                'image' => $imagePath,
                'category_id' => $this->category_id,
            ]);
    
            $this->content = '';
    
            // Emitir el evento para actualizar el contador usando el post recién creado
            $this->dispatch('post-created', ['title' => $post->title]);
        }
    
        session()->flash('message', $this->isEditing ? 'Post updated successfully!' : 'Post created successfully!');
    
        // Redirigir después de guardar
        return redirect()->route('blogs.index');
    }
    
    
    

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        session()->flash('message', 'Post deleted successfully!');
        return redirect()->route('blogs.index');
    }

    public function render()
    {
        return view('livewire.post-management', [
            'categories' => Category::all(),
        ]);
    }
}
