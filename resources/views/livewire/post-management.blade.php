<div>
    @if (session()->has('message'))
        <div class="bg-green-900 border border-green-600 text-green-300 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="savePost" class="space-y-4">
        <div class="mb-4">
            <label for="title" class="block text-gray-600 font-bold mb-2">Título</label>
            <input type="text" id="title" wire:model="title" class="border border-gray-600 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-300">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
                 
        <div class="mb-4" wire:ignore>
            <label for="content" class="block text-gray-600 dark:text-slate-50 font-bold mb-2">Contenido</label>
            <textarea 
                id="content" 
                wire:model.lazy="content" 
                class="ckeditor"
            ></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        

        <div class="mb-4">
            <label for="category_id" class="block text-gray-600 font-bold mb-2">Categoría</label>
            <select id="category_id" wire:model="category_id" class="border border-gray-600 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-300">
                <option value="">Seleccionar categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-600 font-bold mb-2">Imagen</label>
            <input type="file" id="image" wire:model="image" class="border border-gray-600 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-300">
            
            <!-- Mostrar vista previa de la imagen -->
            @if ($imagePreview)
                <img src="{{ $imagePreview }}" alt="Vista previa de la imagen" class="mt-2 w-24 rounded-md">
            @elseif ($existingImage)
                <img src="{{ Storage::url($existingImage) }}" alt="Imagen actual" class="mt-2 w-24 rounded-md">
            @endif
            
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 font-bold mb-2">Etiquetas</label>
            <div class="flex flex-wrap gap-4">
                @foreach ($tags as $tag)
                    <label class="mr-2">
                        <input type="checkbox" 
                               wire:model="tags" 
                               value="{{ $tag->id }}"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tags') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        
        

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-500">
            {{ $isEditing ? 'Actualizar publicación' : 'Crear publicación' }}
        </button>
    </form>

    @if ($isEditing)
        <button wire:click="deletePost({{ $postId }})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-500">Eliminar publicación</button>
    @endif


    <script>
        let editor;
    
        // Inicializar CKEditor y sincronizar con Livewire
        ClassicEditor
            .create(document.querySelector('.ckeditor'), {
                
                language: 'es', // Cambia según el idioma que necesites
            })
            .then(function(leditor) {
                editor = leditor;
    
                
    
                // Sincronizar con Livewire usando wire:model.lazy
                editor.model.document.on('change:data', () => {
                    @this.set('content', editor.getData()); // Sincronizar el contenido con el modelo
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    
    <style>
        /* Aplica las variables al contenedor editable del editor */
        .ck-editor__editable {
            background-color: var(--ck-color-base-background);
            color: var(--ck-color-base-foreground);
            border-color: var(--ck-color-focus-border);
        }
    
        /* Opcional: Ajustar el color del texto del marcador de posición */
        .ck-editor__editable::placeholder {
            color: var(--ck-color-base-foreground);
            opacity: 0.6;
        }
    </style>
</div>



