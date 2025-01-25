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
    //variables para modal de eliminacion
    public $selectedLibro;
    public $showConfirmModal = false;
    public $isProcessing = false;


    


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
        try {
            // Configurar el tiempo de espera para la conexión
            $response = Http::withHeaders([
                'x-api-key' => env('API_KEY'), // Agregar la API Key en los encabezados
            ])
            ->timeout(10)  // Tiempo de espera de 10 segundos
            ->get('https://api-libros-sma.onrender.com/api/libros');
            
            // Verifica si la respuesta fue exitosa antes de procesarla
            if ($response->successful()) {
                $this->libros = $response->json();
            } else {
                // Si la respuesta no fue exitosa, muestra un mensaje de error
                $this->libros = [];
                session()->flash('error', 'No se pudieron cargar los libros. Intenta nuevamente.');
            }
    
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Si ocurre un error de conexión (por ejemplo, el servidor no responde)
            $this->libros = [];
            session()->flash('error', 'No se pudo establecer la conexión con el servidor. Verifica tu conexión a internet.');
            
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Si ocurre algún otro tipo de error en la solicitud
            $this->libros = [];
            session()->flash('error', 'Hubo un error al procesar la solicitud.');
            
        } catch (\Exception $e) {
            // Captura cualquier otro error no esperado
            $this->libros = [];
            session()->flash('error', 'Ocurrió un error inesperado. Intenta nuevamente.');
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
        $rules = [
            'titulo' => 'required|max:255|regex:/^[\p{L}\s]+$/u', // Acepta letras con tildes y espacios
            'autor' => 'required|max:255|regex:/^[\p{L}\s]+$/u',  // Acepta letras con tildes y espacios
            'descripcion' => 'nullable|max:500',
            'categoria' => 'required|max:255|regex:/^[\p{L}\s]+$/u', // Acepta letras con tildes y espacios
            'año_publicacion' => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
        ];
    
        // Mensajes de validación personalizados
        $messages = [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 255 caracteres.',
            'titulo.regex' => 'El título solo puede contener letras, tildes y espacios.',
            'autor.required' => 'El autor es obligatorio.',
            'autor.max' => 'El autor no puede tener más de 255 caracteres.',
            'autor.regex' => 'El autor solo puede contener letras, tildes y espacios.',
            'descripcion.max' => 'La descripción no puede tener más de 500 caracteres.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.max' => 'La categoría no puede tener más de 255 caracteres.',
            'categoria.regex' => 'La categoría solo puede contener letras, tildes y espacios.',
            'año_publicacion.required' => 'El año de publicación es obligatorio.',
            'año_publicacion.numeric' => 'El año de publicación debe ser un número.',
            'año_publicacion.digits' => 'El año de publicación debe tener exactamente 4 dígitos.',
            'año_publicacion.min' => 'El año de publicación debe ser después de 1900.',
            'año_publicacion.max' => 'El año de publicación no puede ser mayor que el año actual.',
        ];
    
        // Validar los datos
        $this->validate($rules, $messages);
    
        // Datos que se van a enviar
        $data = [
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'descripcion' => $this->descripcion,
            'categoria' => $this->categoria,
            'año_publicacion' => $this->año_publicacion,
        ];
    
        try {
            // Hacer la solicitud dependiendo si es editar o crear
            if ($this->is_editing) {
                $response = Http::withHeaders([
                    'x-api-key' => env('API_KEY')
                ])->put("https://api-libros-sma.onrender.com/api/libros/{$this->libro_id}", $data);
            } else {
                $response = Http::withHeaders([
                    'x-api-key' => env('API_KEY')
                ])->post('https://api-libros-sma.onrender.com/api/libros', $data);
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
    
        // Resetear el formulario y obtener la lista de libros
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

    public function confirmDelete($id)
    {
        $this->selectedLibro = $id;
        $this->showConfirmModal = true;
    }
    
    public function deleteLibro()
{
    if (!$this->selectedLibro) {
        return;
    }

    $this->isProcessing = true; // Mostrar el mensaje de "Procesando..."

    try {
        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY')
        ])->delete("https://api-libros-sma.onrender.com/api/libros/{$this->selectedLibro}");

        if ($response->successful()) {
            session()->flash('message', 'Libro eliminado correctamente!');
        } else {
            session()->flash('error', 'Hubo un error al eliminar el libro.');
        }
    } catch (\Exception $e) {
        session()->flash('error', 'Error en la conexión o al procesar la solicitud.');
    }

    $this->selectedLibro = null;
    $this->showConfirmModal = false;
    $this->isProcessing = false; // Ocultar el mensaje de "Procesando..."

    $this->fetchLibros();
}

    

    public function render()
    {
        return view('livewire.libros');
    }
}
