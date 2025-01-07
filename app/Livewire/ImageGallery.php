<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Image;
use App\Models\Album;

class ImageGallery extends Component
{
    use WithPagination;

    public $selectedImage = null;  // Para almacenar la imagen seleccionada para eliminación
    public $showImageModal = false;  // Para mostrar el modal de imagen ampliada
    public $imageModalPath = '';  // Para almacenar la ruta de la imagen ampliada
    public $selectedAlbum = null;
    public $albums;
    public $showAlbumModal = false;
   
    public $newAlbumName = '';


    public function mount()
    {
        $this->albums = Album::all(); // Cargar los álbumes existentes
    }
    // Mostrar las imágenes de la base de datos
    public function render()
    {
        // Trae las últimas 16 imágenes paginadas
        $images = Image::where('user_id', auth()->id())->latest()->paginate(16);

        return view('livewire.image-gallery', compact('images'));
    }

    // Eliminar la imagen seleccionada
    public function deleteImage($imageId)
    {
        $image = Image::findOrFail($imageId);

        // Elimina la imagen del sistema y de la base de datos
        if ($image->user_id === auth()->id()) {
            $image->delete();
        }

        session()->flash('message', 'Imagen eliminada correctamente');
        $this->selectedImage = null;  // Resetear imagen seleccionada
    }

    // Establecer la imagen seleccionada para eliminarla
    public function selectImage($imageId)
    {
        $this->selectedImage = $imageId;
    }

    // Función para mostrar la imagen ampliada en el modal
    public function openImageModal($imageId)
    {
        $image = Image::findOrFail($imageId);
        $this->imageModalPath = $image->path;
        $this->showImageModal = true;
    }

    // Función para cerrar el modal de imagen ampliada
    public function closeImageModal()
    {
        $this->showImageModal = false;
        $this->imageModalPath = '';
    }

    // Marcar la imagen como favorita o quitarla de favoritos
    public function toggleFavorite($imageId)
    {
        $image = Image::findOrFail($imageId);
        
        // Cambiar el estado de favorito
        $image->is_favorite = !$image->is_favorite;
        $image->save();

        session()->flash('message', $image->is_favorite ? 'Imagen agregada a favoritos' : 'Imagen eliminada de favoritos');
    }

    // Crear un nuevo álbum y agregar la imagen seleccionada
    public function addToAlbum($imageId)
    {
        $image = Image::findOrFail($imageId);

        // Aquí se crea el álbum (si es necesario) o se agrega a uno existente
        $album = Album::firstOrCreate(
            ['user_id' => auth()->id(), 'name' => 'Nuevo Álbum']
        );

        // Asociamos la imagen al álbum
        $album->images()->syncWithoutDetaching([$this->selectedImage]);


        session()->flash('message', 'Imagen agregada al álbum correctamente');
    }

    // Agregar la imagen al álbum seleccionado



 // Abrir modal de álbum
 public function openAlbumModal($imageId)
 {
     $this->selectedImage = $imageId; // Actualiza correctamente la imagen seleccionada
     $this->albums = Album::where('user_id', auth()->id())->get(); // Filtra por usuario
     $this->showAlbumModal = true; // Muestra el modal
 }

 
 public function addImageToAlbum()
{
    $this->validate([
        'selectedAlbum' => 'required|exists:albums,id',
    ]);

    if (!$this->selectedImage) {
        session()->flash('error', 'No se seleccionó ninguna imagen.');
        return;
    }

    $album = Album::find($this->selectedAlbum);

    // Asociar la imagen al álbum sin duplicar
    $album->images()->syncWithoutDetaching([$this->selectedImage]);

    $this->closeAlbumModal();
    session()->flash('message', 'Imagen agregada al álbum exitosamente.');
}

 
 

 // Cerrar modal de álbum
 public function closeAlbumModal()
 {
    $this->showAlbumModal = false;
    $this->selectedAlbum = null;
    //$this->newAlbumName = '';
    $this->selectedImage = null;

 }

 public function createAlbum()
 {
     if (!auth()->check()) {
         session()->flash('error', 'Debes estar autenticado para crear un álbum.');
         return;
     }
 
     $this->validate([
         'newAlbumName' => 'required|string|max:255',
     ]);
 
     Album::create([
         'name' => $this->newAlbumName,
         'user_id' => auth()->id(),
     ]);
 
     $this->albums = Album::all();
     $this->newAlbumName = '';
     session()->flash('message', 'Álbum creado exitosamente.');
 }
 

 

}
