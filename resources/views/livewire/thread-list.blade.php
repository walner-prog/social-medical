<div class="space-y-6">
    <!-- Mensajes de sesión -->
    @if(session()->has('message'))
        <div class="p-3 text-green-700 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @elseif(session()->has('error'))
        <div class="p-3 text-red-700 bg-red-100 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario para crear/editar temas -->
    <div class="p-6  dark:bg-gray-800 ">
        <button wire:click="toggleForm" class="bg-blue-600 mb-2 text-white px-3 py-1 rounded-md flex items-center space-x-2">
        
         <span>Agregar</span>
             
        </button>

        @if ($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
            <div class="bg-white dark:bg-indigo-700 shadow-lg rounded-md border border-gray-300 p-6 sm:p-8 w-full max-w-sm sm:max-w-md lg:max-w-lg overflow-auto max-h-[80vh] relative">
            <h2 class="text-lg font-semibold mb-4">{{ $editingThreadId ? 'Editar Tema' : 'Crear un Nuevo Tema' }}</h2>
            <button wire:click="toggleForm" class="bg-blue-600 mb-2 text-white px-3 py-1 rounded-md flex items-center space-x-2">
                @if ($showForm)
                    <span>Ocultar Formulario</span>
                @else
                    <span>Agregar</span>
                @endif
            </button>
            <form wire:submit.prevent="{{ $editingThreadId ? 'updateThread' : 'createThread' }}">
                <input type="text" wire:model="title" class="w-full p-2 border rounded dark:bg-gray-800 mb-2" placeholder="Título del tema" />
                @error('title') <p class="text-red-500">{{ $message }}</p> @enderror

                <textarea wire:model="content" class="w-full p-2 border rounded dark:bg-gray-800 mb-2" placeholder="Contenido del tema"></textarea>
                @error('content') <p class="text-red-500">{{ $message }}</p> @enderror

                <select wire:model="specialty" class="w-full p-2 border rounded dark:bg-gray-800 mb-2">
                    <option value="">Selecciona una especialidad</option>
                    <option value="Cardiología">Cardiología</option>
                    <option value="Pediatría">Pediatría</option>
                    <option value="Nutrición">Nutrición</option>
                </select>
                @error('specialty') <p class="text-red-500">{{ $message }}</p> @enderror

                <button type="submit" class="px-4 py-2 mt-4 bg-blue-600 text-white rounded">
                    {{ $editingThreadId ? 'Actualizar Tema' : 'Crear Tema' }}
                </button>
            </form>
        </div>
    @endif

    </div>

    <!-- Lista de temas -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <input 
                type="text" 
                wire:model="search" 
                class="p-2 border rounded" 
                placeholder="Buscar temas..."
            />
            <select wire:model="filterSpecialty" class="p-2 border rounded">
                <option value="">Todas las especialidades</option>
                <option value="Cardiología">Cardiología</option>
                <option value="Pediatría">Pediatría</option>
                <option value="Nutrición">Nutrición</option>
            </select>
        </div>

        @foreach($threads as $thread)
            <div class="p-4 mb-4 bg-white rounded shadow dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-blue-600 cursor-pointer" 
                wire:click="viewThread({{ $thread->id }})">
                {{ $thread->title }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $thread->specialty ?? 'General' }}</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $thread->content }}</p>
                <div class="mt-4">
                    <button 
                        wire:click="editThread({{ $thread->id }})" 
                        class="px-3 py-1 text-sm bg-yellow-500 text-white rounded"
                    >
                        Editar
                    </button>
                    <button 
                        wire:click="confirmDelete({{ $thread->id }})"
                        class="px-3 py-1 text-sm bg-red-500 text-white rounded"
                    >
                        Eliminar
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    @if ($confirmingDelete)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow">
            <p>¿Estás seguro de que deseas eliminar este tema?</p>
            <div class="mt-4">
                <button wire:click="deleteThread" class="px-4 py-2 bg-red-500 text-white rounded">Sí, eliminar</button>
                <button wire:click="$set('confirmingDelete', null)" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
            </div>
        </div>
    </div>
@endif

</div>
