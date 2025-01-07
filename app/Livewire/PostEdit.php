<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostEdit extends Component
{
    use WithFileUploads;

    public $postId;
    public $title;
    public $content;
    public $image;
    public $category_id;
    public $existingImage;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048',
        'category_id' => 'required|exists:categories,id',
    ];

    public function mount($post)
    {
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->category_id = $post->category_id;
        $this->existingImage = $post->image;
    }

    public function savePost()
    {
        $this->validate();

        $imagePath = $this->existingImage;
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        $post = Post::findOrFail($this->postId);
        $post->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'image' => $imagePath,
            'category_id' => $this->category_id,
        ]);

        session()->flash('message', 'Post updated successfully!');
        return redirect()->route('blogs.index');
    }

    public function render()
    {
        return view('livewire.post-edit', [
            'categories' => Category::all(),
        ]);
    }
}
