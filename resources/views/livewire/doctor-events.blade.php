<div class="">
    @if (auth()->check() && auth()->user()->hasRole('doctor'))
    <div class="mt-6">
      
        @if(session()->has('message') || session()->has('error'))
        <div id="flash-message" class="mt-4 max-w-lg mx-auto p-4 rounded-lg text-white flex items-center space-x-3 
            @if(session()->has('error')) bg-red-500 @else bg-indigo-800 @endif">
            <svg class="h-6 w-6"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                @if(session()->has('error'))
                    <!-- Icono de error -->
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                @else
                    <!-- Icono de éxito -->
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                @endif
            </svg>
            <span>{{ session('message') ?? session('error') }}</span>
        </div>
    @endif
    
   
        <!-- Formulario para agregar o editar un evento -->
        @if ($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
            <div class="bg-white dark:bg-indigo-700 shadow-lg rounded-md border border-gray-300 p-6 sm:p-8 w-full max-w-sm sm:max-w-md lg:max-w-lg overflow-auto max-h-[80vh] relative">
                <button wire:click="toggleForm" class="absolute top-2 right-2 text-white bg-red-500 rounded-full p-2 hover:bg-red-600">
                    <i class="fas fa-times"></i>
                </button>
            <form wire:submit.prevent="saveEvent" class="mb-4">
                <!-- Campo: Título del Evento -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título del Evento</label>
                    <div class="relative">
                        <i class="fas fa-calendar-alt absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" id="title" wire:model="title" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" 
                            placeholder="Título del evento" />
                    </div>
                    @error('title') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Fecha de Inicio -->
                <div class="mb-4">
                    <label for="start" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Inicio</label>
                    <div class="relative">
                        <i class="fas fa-calendar-day absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="date" id="start" wire:model="start" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" />
                    </div>
                    @error('start') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Fecha de Fin -->
                <div class="mb-4">
                    <label for="end" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Fin</label>
                    <div class="relative">
                        <i class="fas fa-calendar-day absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="date" id="end" wire:model="end" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" />
                    </div>
                    @error('end') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
                
                <!-- Campo: Descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                    <div class="relative">
                        <i class="fas fa-pencil-alt absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <textarea id="description" wire:model="description" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" placeholder="Descripción del evento"></textarea>
                    </div>
                    @error('description') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Ubicación -->
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" id="location" wire:model="location" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" placeholder="Ubicación del evento" />
                    </div>
                    @error('location') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Hora -->
                <div class="mb-4">
                    <label for="hour" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hora</label>
                    <div class="relative">
                        <i class="fas fa-clock absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="time" id="hour" wire:model="hour" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" />
                    </div>
                    @error('hour') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Costo -->
                <div class="mb-4">
                    <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Costo</label>
                    <div class="relative">
                        <i class="fas fa-dollar-sign absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" id="cost" wire:model="cost" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" placeholder="Costo del evento" />
                    </div>
                    @error('cost') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Público Objetivo -->
                <div class="mb-4">
                    <label for="audience" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Público Objetivo</label>
                    <div class="relative">
                        <i class="fas fa-users absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" id="audience" wire:model="audience" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" placeholder="Público objetivo del evento" />
                    </div>
                    @error('audience') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Campo: Registro -->
                <div class="mb-4">
                    <label for="registration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Registro</label>
                    <div class="relative">
                        <i class="fas fa-sign-in-alt absolute left-2 top-3 text-gray-400 dark:text-gray-500"></i>
                        <input type="text" id="registration" wire:model="registration" 
                            class="mt-1 p-2 w-full pl-10 border rounded-md dark:bg-gray-800" placeholder="Información sobre el registro" />
                    </div>
                    @error('registration') <span class="text-red-500 text-sm dark:bg-white">{{ $message }}</span> @enderror
                </div>
        
                <!-- Botón de envío -->
                <div>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md flex items-center justify-center w-full">
                        <i class="fas fa-save mr-2"></i>
                        @if ($selectedEvent) Actualizar Evento @else Guardar Evento @endif
                    </button>
                </div>
            </form>
          </div>
        </div>
        @endif

        <!-- Tabla de eventos -->
        <div class="p-4">
            <div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Eventos <span class="text-gray-500">({{ $events->count() }})</span></h2>
                    <div class="flex items-center space-x-4">
                    
                        <!-- Botón principal siempre visible -->
                        <button 
                            wire:click="toggleForm" 
                            class="bg-blue-600 text-white px-3 py-1 rounded-md flex items-center space-x-2"
                        >
                            @if ($showForm)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span>Ocultar Formulario</span>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Agregar</span>
                            @endif
                        </button>
            
                        <!-- Dropdown para pantallas pequeñas -->
                        <div class="relative md:hidden ">
                            <button 
                                class="bg-gray-200 text-gray-700 px-3 py-1 rounded-md flex items-center space-x-1"
                                onclick="toggleDropdown(event)"
                            >
                                <span>Más Opciones</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 bg-white dark:bg-slate-700 p-1  shadow-md rounded-md w-48 hidden dropdown-menu">
                                <button wire:click="filterEvents('activos')" class="border border-gray-300 rounded-md px-3 py-1 text-sm mb-1">Activos</button>
                                <button wire:click="filterEvents('archivados')" class="border border-gray-300 rounded-md px-3 py-1 text-sm mb-1">Archivados</button>
                        
                                <button wire:click="changeViewMode('list')" class="border border-gray-300 rounded-md px-3 py-1 text-sm mb-1">Lista</button>
                                <button wire:click="changeViewMode('grid')" class="bg-black text-white rounded-md px-3 py-1 text-sm mb-1">Cuadrícula</button>
                            
                            </div>
                        </div>
            
                        <!-- Botones visibles solo en pantallas medianas y grandes -->
                        <div class="hidden md:flex items-center space-x-4">
                            <button wire:click="filterEvents('activos')" class="border border-gray-300 rounded-md px-3 py-1 text-sm">Activos</button>
                            <button wire:click="filterEvents('archivados')" class="border border-gray-300 rounded-md px-3 py-1 text-sm">Archivados</button>
                            <span class="text-gray-500">Ordenar:</span>
                            <select wire:model="orderBy" class=" dark:bg-slate-700 border-gray-300 rounded-md px-2 py-1 text-sm">
                                <option value="desc">Más recientes</option>
                                <option value="asc">Más antiguos</option>
                            </select>
                            <div class="flex items-center space-x-2">
                                <button wire:click="changeViewMode('list')" class="border border-gray-300 rounded-md px-3 py-1 text-sm">Lista</button>
                                <button wire:click="changeViewMode('grid')" class="bg-black text-white rounded-md px-3 py-1 text-sm">Cuadrícula</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            
                <!-- Tabla responsiva -->
                @if ($viewMode === 'grid')
                <!-- Vista en cuadrícula -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <div class="border p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-all">
                            <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-500">Inicio: {{ $event->start }}</p>
                            <p class="text-sm text-gray-500">Fin: {{ $event->end }}</p>
                            <div class="mt-4 flex space-x-4">
                                <button wire:click="editEvent({{ $event->id }})" class="text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-400">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button wire:click="deleteEvent({{ $event->id }})" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-600">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Vista en lista -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-200 text-gray-700 text-sm">
                            <tr>
                                <th class="py-2">
                                    <input type="checkbox" wire:model="selectAll" class="form-checkbox text-blue-600 m-1">

                                </th>
                                <!-- Título -->
                                <th class="py-2">
                                    <button wire:click="changeOrder('title')" class="text-sm text-blue-600 hover:text-blue-800">
                                        Título
                                    </button>
                                </th>
                    
                                <!-- Inicio -->
                                <th>
                                    <button wire:click="changeOrder('start')" class="text-sm text-blue-600 hover:text-blue-800">
                                        Inicio
                                    </button>
                                </th>
                    
                                <!-- Fin -->
                                <th>
                                    <button wire:click="changeOrder('end')" class="text-sm text-blue-600 hover:text-blue-800">
                                        Fin
                                    </button>
                                </th>
                    
                                <!-- Acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($events as $event)
                                <tr class="border-t hover:bg-gray-100 dark:hover:bg-slate-500 dark:hover:text-slate-100">
                                    <td class="py-3">
                                        <input type="checkbox" wire:model="selectedEvents" value="{{ $event->id }}" class="form-checkbox text-blue-600 m-1">
                                    </td>
                                    <td class="py-3">{{ $event->title }}</td>
                                    <td>{{ $event->start }}</td>
                                    <td>{{ $event->end }}</td>
                                    <td>
                                        <div class="flex space-x-4">
                                            <button wire:click="editEvent({{ $event->id }})" class="text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-400">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <button wire:click="deleteEvent({{ $event->id }})" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-600">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            @endif
            
            <div class="mt-4">
                {{ $events->links() }}
            </div>
            
            </div>
        </div>
       
        
        <script>
            function toggleDropdown(event) {
                const dropdown = event.target.closest('div').querySelector('.dropdown-menu');
                dropdown.classList.toggle('hidden');
            }
        </script>
        
        
    </div>
    @else
        <!-- Mensaje para usuarios sin permiso -->
        <div class="mt-6">
            <p class="text-red-500">No tienes permiso para gestionar eventos.</p>
        </div>
    @endif

   
</div>

<script>
    window.onload = function () {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.transition = 'opacity 0.5s ease';
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 500); // Remueve el elemento después de la animación
            }, 5000);
        }
    };
</script>