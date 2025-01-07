<div class="max-w-7xl mx-auto mt-8 bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg">
    <!-- Titulo de la sección -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-slate-200">Actualizar Publicación</h2>
        <p class="text-gray-600 dark:text-slate-400 mt-2">Aquí puedes actualizar el título, contenido, categoría y la imagen de tu publicación. Asegúrate de que la información ingresada sea correcta antes de enviarla.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-6">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="savePost" class="space-y-6">
        <!-- Title -->
        <div>
            <label for="title" class="block text-lg font-semibold text-gray-700 dark:text-slate-200">Titulo</label>
            <input type="text" id="title" wire:model="title" class="mt-2 p-3 w-full border dark:bg-sky-950 dark:text-slate-300 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter the title">
            @error('title') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-4" wire:ignore>
            <label for="content" class="block text-lg font-semibold text-gray-700 dark:text-slate-200">Contenido</label>
            <textarea id="content" wire:model.lazy="content" class="ckeditor">{{ $content }}</textarea> 
            @error('content') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>
        


        <!-- Category -->
        <div>
            <label for="category_id" class="block text-lg font-semibold text-gray-700 dark:text-slate-200">Categoria</label>
            <select id="category_id" wire:model="category_id" class="mt-2 p-3 w-full border dark:bg-sky-950 dark:text-slate-300 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="block text-lg font-semibold text-gray-700 dark:text-slate-200">Imagen</label>
            <input type="file" id="image" wire:model="image" class="mt-2 p-3 w-full border dark:bg-sky-950 dark:text-slate-300 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            @if ($existingImage)
                <div class="mt-4">
                    <img src="{{ Storage::url($existingImage) }}" alt="Current Image" class="w-24 h-24 object-cover rounded-md">
                </div>
            @endif
            
            @error('image') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Actualizar Post
            </button>
        </div>
    </form>
</div>

<script>
    let editor;

    // Inicializar CKEditor y sincronizar con Livewire
    ClassicEditor
        .create(document.querySelector('.ckeditor'))
        .then(function(leditor) {
            editor = leditor;

            // Sincronizar con Livewire usando wire:model.lazy
            editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData()); // Usamos 'content' como el campo del modelo
            });
        })
        .catch(error => {
            console.error(error);
        });


</script>