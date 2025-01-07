<div class="container mx-auto mt-8">
    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m0 0l4 4l2-2M5 12l2 2l4-4m0 0l4 4l2-2" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    </div>
    @endif

    <div class="text-center mb-6 px-4">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-gray-200">
            Organiza tus recuerdos con facilidad
        </h2>
        <p class="text-gray-600 text-base leading-relaxed">
            En esta sección, puedes crear y personalizar tus álbumes para guardar tus momentos más preciados. 
            Comparte tus imágenes favoritas con amigos y familiares, y mantén todo organizado de manera sencilla. 
            Disfruta de una interfaz diseñada para brindarte comodidad y una experiencia visual amigable.
        </p>
    </div>
    
    <!-- Galería de Imágenes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($images as $image)
        <div class="relative group">
            <img src="{{ $image->path }}" alt="{{ $image->name }}" class="w-full h-auto rounded-lg cursor-pointer" wire:click="openImageModal({{ $image->id }})">
            
           
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $images->links() }}
    </div>

    <!-- Modal para ver imagen ampliada -->
    @if ($showImageModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
        <div class="bg-white p-4 rounded-lg relative">
            <img src="{{ $imageModalPath }}" alt="Imagen Ampliada" class="w-full max-w-md rounded-lg">
            
            <div class="absolute top-2 left-2 flex space-x-2">
                <button wire:click="deleteImage({{ $image->id }})" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                    Eliminar
                </button>
                <button wire:click="toggleFavorite({{ $image->id }})" class="bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600">
                    {{ $image->is_favorite ? 'Quitar Favorito' : 'Agregar a Favoritos' }}
                </button>
                <button wire:click="openAlbumModal({{ $image->id }})" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600">
                    Crear/Agregar a Álbum
                </button>
            </div>

            <button wire:click="closeImageModal" class="bg-red-500 text-white p-2 rounded-lg mt-4">Cerrar</button>
        </div>
    </div>
    @endif

 
@if ($showAlbumModal)
<div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
    <div class="bg-white p-4 rounded-lg relative w-96">
        <h3 class="text-xl mb-4">Selecciona o Crea un Álbum</h3>
        
        <!-- Selección de álbum existente -->
        <select wire:model="selectedAlbum" class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300  border p-2 rounded-lg mb-4 w-full">
            <option value="">Selecciona un álbum</option>
            @foreach ($albums as $album)
                <option value="{{ $album->id }}">{{ $album->name }}</option>
            @endforeach
        </select>
        <button wire:click="addImageToAlbum({{ $selectedImage }})" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 w-full mb-4">
            Agregar al Álbum
        </button>

        <!-- Crear un nuevo álbum -->
        <h4 class="text-lg mb-2">Crear un Nuevo Álbum</h4>
        <input type="text" wire:model="newAlbumName" placeholder="Nombre del álbum" class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border p-2 rounded-lg w-full mb-2">
        <button wire:click="createAlbum" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 w-full">
            Crear Álbum
        </button>

        <!-- Botón para cerrar el modal -->
        <button wire:click="closeAlbumModal" class="bg-red-500 text-white p-2 rounded-lg mt-4 w-full">
            Cerrar
        </button>
    </div>
</div>
@endif

</div>
