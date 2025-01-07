<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index');
    }



    public function QuienesSomos()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
    
        // Verificar si el usuario está registrado (campo 'registered' es true)
        $isRegistered = $user && $user->registered;
    
        // Pasar la variable a la vista
        return view('quienes-soomos', compact('isRegistered'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function edit($postId) 
    {
          $post = Post::findOrFail($postId);
          return view('blog.edit', ['post' => $post]);
     }

    public function show(Post $post)
{
    $post->load('category'); // Asegura que la categoría esté cargada

    $post->increment('views');
    return view('blog.show', compact('post'));
}

public function accionPost()
 { 
    return view('blog.post_accions');
 }

}
