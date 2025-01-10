<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Libros extends Component
{
    public $libros = [];
    public $titulo, $autor, $descripcion, $categoria, $año_publicacion;
    public $libro_id; // Para editar libros
    public $is_editing = false;
    public $show_modal = false; 

    public function mount()
    {
        $this->fetchLibros();
     //   $this->show_modal = false;
      
    }

    public function showModal() {
        $this->show_modal = true;
    }
    
    public function hideModal() {
        $this->show_modal = false;
    }

    public function fetchLibros()
    {
        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY') // Agregar la API Key en los encabezados
        ])->get('http://localhost:5000/api/libros');
    
        // Verifica si la respuesta fue exitosa antes de procesarla
        if ($response->successful()) {
            $this->libros = $response->json();
        } else {
            // Maneja el error (por ejemplo, muestra un mensaje de error)
            $this->libros = [];
            // Aquí puedes agregar más lógica para mostrar el mensaje de error
        }

      
    }
    

   

    public function resetForm()
    {
        $this->titulo = '';
        $this->autor = '';
        $this->descripcion = '';
        $this->categoria = '';
        $this->año_publicacion = '';
        $this->libro_id = null;
        $this->is_editing = false;
        $this->show_modal = false;
    }


    public function saveLibro()
{

     // Reglas de validación
      $data = [
        'titulo' => 'required|max:255',
        'autor' => 'required|max:255',
        'descripcion' => 'nullable|max:500',
        'categoria' => 'required|max:255',
        'año_publicacion' => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
    ];

    $this->validate($data);

    $data = [
        'titulo' => $this->titulo,
        'autor' => $this->autor,
        'descripcion' => $this->descripcion,
        'categoria' => $this->categoria,
        'año_publicacion' => $this->año_publicacion,
    ];

    try {
        if ($this->is_editing) {
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY')
            ])->put("http://localhost:5000/api/libros/{$this->libro_id}", $data);
        } else {
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY')
            ])->post('http://localhost:5000/api/libros', $data);
        }

        // Verificar si la respuesta fue exitosa
        if ($response->successful()) {
            session()->flash('message', 'Libro guardado correctamente!');
        } else {
            // Manejar errores si la respuesta no es exitosa
            session()->flash('error', 'Hubo un error al guardar el libro.');
        }
    } catch (\Exception $e) {
        // Capturar errores generales y emitir un mensaje de error
        session()->flash('error', 'Error en la conexión o al procesar la solicitud.');
    }

    $this->resetForm();
    $this->fetchLibros();
   // $this->show_modal = false;
}


    public function editLibro($libro)
    {
        $this->titulo = $libro['titulo'];
        $this->autor = $libro['autor'];
        $this->descripcion = $libro['descripcion'];
        $this->categoria = $libro['categoria'];
        $this->año_publicacion = $libro['año_publicacion'];
        $this->libro_id = $libro['id'];
        $this->is_editing = true;
        $this->show_modal = true; 
    }

    public function deleteLibro($id)
    {
        try {
            // Realizar la solicitud de eliminación
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY')
            ])->delete("http://localhost:5000/api/libros/{$id}");
    
            // Verificar si la respuesta fue exitosa
            if ($response->successful()) {
                session()->flash('message', 'Libro eliminado correctamente!');
            } else {
                // Si la eliminación no fue exitosa, mostrar un error
                session()->flash('error', 'Hubo un error al eliminar el libro.');
            }
        } catch (\Exception $e) {
            // Capturar errores generales y emitir un mensaje de error
            session()->flash('error', 'Error en la conexión o al procesar la solicitud.');
        }
    
        // Volver a obtener los libros después de la eliminación
        $this->fetchLibros();
    }
    

    public function render()
    {
        return view('livewire.libros');
    }
}
