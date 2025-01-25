<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Catálogo de Libros</h1>

    <!-- Botón para abrir el modal de agregar libro -->
    <button wire:click="showModal" class="bg-blue-900 text-white px-4 py-2 rounded mb-4 hover:bg-blue-800 transition duration-300 ease-in-out transform hover:scale-105">
        Agregar Libro
    </button>

    <!-- Mostrar mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 flex items-center rounded-lg shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4m0 0l2-2m-6 6H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-8z"/>
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 flex items-center rounded-lg shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m0 4v.01M5 5l14 14"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Modal de agregar/editar libro -->
    <div wire:model="show_modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300 ease-in-out" style="display: {{ $show_modal ? 'flex' : 'none' }};">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3 transform transition-transform duration-300 ease-in-out scale-95 {{ $show_modal ? 'scale-100' : '' }}">
            <h2 class="text-xl font-semibold mb-4 text-center">{{ $is_editing ? 'Editar Libro' : 'Agregar Libro' }}</h2>
               
           
            <form wire:submit.prevent="saveLibro">
                <div class="mb-4">
                    <label class="block font-medium">Título <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="titulo" class="w-full dark:bg-slate-700 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required />
                    @error('titulo') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-500">Acepta solo texto, máximo 255 caracteres.</small>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Autor <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="autor" class="w-full dark:bg-slate-700 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" />
                    @error('autor') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-500">Acepta solo texto, máximo 255 caracteres.</small>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Descripción</label>
                    <textarea wire:model="descripcion" class="w-full dark:bg-slate-700 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('descripcion') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-500">Máximo 500 caracteres.</small>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Categoría <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="categoria" class="w-full dark:bg-slate-700 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" />
                    @error('categoria') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-500">Acepta solo texto, máximo 255 caracteres.</small>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Año de Publicación <span class="text-red-500">*</span></label>
                    <input type="number" wire:model="año_publicacion" class="w-full dark:bg-slate-700 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" />
                    @error('año_publicacion') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <small class="text-gray-500">Debe ser un año entre 1900 y el año actual.</small>
                </div>
    
                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-950 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300 ease-in-out">
                        {{ $is_editing ? 'Actualizar' : 'Guardar' }}
                    </button>
                    <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
    


    

    <!-- Listado de Libros -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        @foreach ($libros as $libro)
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
                <h2 class="text-xl font-semibold">{{ $libro['titulo'] }}</h2>
                <p><strong>Autor:</strong> {{ $libro['autor'] }}</p>
                <p><strong>Categoría:</strong> {{ $libro['categoria'] }}</p>
                <p><strong>Año:</strong> {{ $libro['año_publicacion'] }}</p>
                <p>{{ $libro['descripcion'] }}</p>
                <div class="mt-2 flex space-x-2">
                    <button wire:click="editLibro({{ json_encode($libro) }})" class="bg-emerald-700 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition duration-300 ease-in-out flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                    </button>
                   
                    <button 
                    wire:click="confirmDelete({{ $libro['id'] }})" 
                    class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 ease-in-out flex items-center space-x-2">
                        <i class="fas fa-trash-alt"></i>
                   </button>
                </div>
            </div>
        @endforeach
    </div>

    @if($showConfirmModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-md">
            @if($isProcessing)
                <h2 class="text-lg font-bold text-red-700 bg-violet-300 mb-4 text-center">Procesando...</h2>
                <p class="text-center">Por favor, espera mientras procesamos tu solicitud.</p>
            @else
                <h2 class="text-lg font-bold mb-4">Confirmación</h2>
                <p>¿Estás seguro de que deseas eliminar este libro?</p>
                <div class="flex justify-end mt-4">
                    <button 
                        wire:click="$set('showConfirmModal', false)" 
                        class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
                        Cancelar
                    </button>
                    <button 
                        wire:click="deleteLibro" 
                        class="bg-red-500 text-white px-4 py-2 rounded">
                        Confirmar
                    </button>
                </div>
            @endif
        </div>
    </div>
    
@endif

</div>
