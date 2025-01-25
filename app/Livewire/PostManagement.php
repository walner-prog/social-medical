<?php

namespace App\Livewire;

use Livewire\Component;
 use Livewire\WithFileUploads;
 use App\Models\Post;
 use App\Models\Category;
 use App\Models\Tag;
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
    public $tags = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'array', // Validar que sea un array
        'tags.*' => 'exists:tags,id', // Validar que cada etiqueta exista en la base de datos
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
            $this->tags = $post->tags()->pluck('id')->toArray();
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
            $imagePath = $this->image->store('images', 'public');
        }


    // Limpiar el contenido
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $cleanContent = $purifier->purify($this->content);

    if ($this->isEditing) {
        $post = Post::findOrFail($this->postId);
        $post->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $cleanContent,
            'image' => $imagePath,
            'category_id' => $this->category_id,
        ]);

        // Sincronizar etiquetas
        $post->tags()->sync($this->tags);
    } else {
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $cleanContent,
            'image' => $imagePath,
            'category_id' => $this->category_id,
        ]);

        // Sincronizar etiquetas
        $post->tags()->sync($this->tags);
    }

    session()->flash('message', $this->isEditing ? 'Post actualizado con éxito!' : 'Post creado con éxito!');
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
    //$tags = Tag::all();
   // dd($tags); // Esto mostrará los tags en la vista de Livewire
    return view('livewire.post-management', [
        'categories' => Category::all(),
        'tags' => Tag::all(),// Todas las etiquetas disponibles
    ]);
}

}
