<div class="space-y-6">

    <!-- Filtros -->
    <div class="flex flex-wrap gap-6 items-center justify-between">
        <!-- Campo de búsqueda -->
        <div class="flex items-center bg-white rounded-full shadow-lg p-2 w-full sm:w-auto">
            <i class="fas fa-search text-gray-500 mr-2"></i>
            <input 
                type="text" 
                wire:model.defer="tempSearch" 
                placeholder="Buscar por nombre, especialidad o ciudad"
                class="border-0 rounded-full px-4 py-2 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Select para especialidad -->
        <div class="relative">
            <select 
                wire:model.defer="tempSpecialty" 
                class="block w-full sm:w-64 px-4 py-2 rounded-md dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las especialidades</option>
                @foreach (App\Models\Doctor::select('specialty')->distinct()->pluck('specialty') as $specialty)
                    <option value="{{ $specialty }}">{{ $specialty }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select para ciudad -->
        <div class="relative">
            <select 
                wire:model.defer="tempCity" 
                class="block w-full sm:w-64 px-4 py-2 rounded-md dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las ciudades</option>
                @foreach (App\Models\Doctor::select('city')->distinct()->pluck('city') as $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por experiencia mínima -->
        <div class="relative">
            <input 
                type="number" 
                wire:model.defer="tempExperienceYears" 
                placeholder="Años de experiencia mínima"
                min="0"
                class="block w-full sm:w-64 px-4 py-2 rounded-md dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Botón para aplicar búsqueda y filtros -->
        <button 
            wire:click="applyFilters" 
            class="bg-blue-600 dark:bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
            <i class="fas fa-search mr-2"></i> Buscar
        </button>
    </div>

    <!-- Listado de doctores -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($doctors as $doctor)
        <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out p-4 dark:bg-teal-900 text-gray-800 dark:text-gray-100">
            <div class="flex flex-col justify-between h-full">
                <!-- Información del doctor -->
                <h2 class="text-2xl font-semibold text-blue-600">{{ $doctor->user->name }}</h2>
                <p class="text-lg text-gray-700 dark:text-gray-300">
                    <i class="fas fa-stethoscope text-blue-500 mr-2"></i> {{ $doctor->specialty }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-map-marker-alt text-teal-500 mr-2"></i> {{ $doctor->city }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-briefcase text-yellow-500 mr-2"></i> {{ $doctor->experience_years }} años de experiencia
                </p>

                <!-- Calificación promedio -->
                <div class="mt-4 flex items-center">
                    <span class="mr-2 text-gray-500 dark:text-gray-300">Promedio de calificación:</span>
                    <div class="flex">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas fa-star {{ $doctor->average_rating >= $i + 1 ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>

                <!-- Enlace para ver más -->
                <a 
                    href="{{ route('doctor.detalle', ['user' => $doctor->user_id]) }}"
                    class="mt-4 bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out text-center">
                    <i class="fas fa-info-circle mr-2"></i> Ver más
                </a>
            </div>
        </div>
        @empty
        <!-- Mensaje cuando no hay resultados -->
        <p class="col-span-3 text-center text-gray-600 dark:text-gray-300">
            No se encontraron doctores con los criterios seleccionados.
        </p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $doctors->links() }}
    </div>

</div>
