<div>
    <!-- Filtros -->
    <div class="mb-4">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <!-- Filtro por Ciudad -->
            <div class="w-full md:w-1/3">
                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ciudad</label>
                <input type="text" id="city" wire:model="city" class="mt-1 p-2 w-full border rounded-md dark:text-gray-800" placeholder="Ej: Managua" />
            </div>
    
            <!-- Filtro por Años de experiencia -->
            <div class="w-full md:w-1/3">
                <label for="experience_years" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Años de experiencia (min)</label>
                <input type="number" id="experience_years" wire:model="experienceYears" class="mt-1 p-2 w-full border rounded-md dark:text-gray-800" placeholder="Ej: 5" />
            </div>
    
            <!-- Botón para aplicar filtros -->
            <div class="w-full md:w-1/3 py-6">
                <button wire:click="applyFilters" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out w-full md:w-auto">
                    Filtrar
                </button>
            </div>
        </div>
    </div>
    

    <!-- Mensaje si no se encuentran doctores -->
    @if($doctors->isEmpty())
        <div class="bg-yellow-200 text-yellow-800 p-4 rounded-md mt-4">
            <p>No se encontraron doctores que coincidan con los criterios de búsqueda.</p>
        </div>
    @else
        <!-- Lista de doctores -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @foreach ($doctors as $doctor)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out p-4 dark:bg-indigo-900 text-gray-800 dark:text-gray-100">
                    <div class="flex flex-col justify-between h-full">
                        <h2 class="text-2xl font-semibold text-indigo-900 dark:text-indigo-200">{{ $doctor->user->name }}</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-300">
                            <i class="fas fa-stethoscope text-blue-500 mr-2"></i> {{ $doctor->specialty }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-map-marker-alt text-teal-500 mr-2"></i> {{ $doctor->city }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-briefcase text-yellow-500 mr-2"></i> {{ $doctor->experience_years }} años de experiencia 
                        </p>

                        <div class="mt-4 flex items-center">
                            <span class="mr-2 text-gray-500 dark:text-gray-300">Promedio de calificación:</span>
                            <div class="flex">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star {{ $doctor->average_rating >= $i + 1 ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </div>

                        <a href="{{ route('doctor.detalle', ['user' => $doctor->user_id]) }}" class="mt-4 border border-blue-900 text-blue-900 dark:border-blue-200 dark:text-white dark:hover:bg-blue-900 py-2 px-6 rounded-md hover:bg-blue-900 hover:text-white transition duration-300 ease-in-out text-center">
                            <i class="fas fa-info-circle mr-2"></i> Ver más
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($doctors->count() >= $this->perPage)
            <button wire:click="loadMore" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Cargar más
            </button>
        @endif
    @endif
</div>
