<div class="bg-gradient-to-b from-[#0F1020] to-[#1B1D35] py-8 min-h-screen flex flex-col px-6 md:px-12 dark:bg-gray-900 dark:text-gray-100">
    <!-- Título de la sección -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-indigo-500 mb-4 animate-pulse">
            ¡Descubre a los mejores especialistas!
        </h1>
        <p class="text-lg text-gray-400">
            Encuentra al doctor ideal para ti. Conoce su experiencia, idiomas y especialidad para asegurarte la mejor atención.
        </p>
    </div>

    <!-- Grid de doctores -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
        @foreach ($doctors as $doctor)
            <div class="flex flex-col md:flex-row items-center bg-gray-800 rounded-lg p-6 shadow-lg transition duration-500 hover:shadow-2xl transform hover:scale-105 group relative">
                <!-- Icono flotante decorativo -->
                <div class="absolute top-2 left-2 w-10 h-10 bg-indigo-500 rounded-full animate-spin-slow"></div>

                <!-- Imagen del doctor -->
                <div class="relative">
                    <img src="{{ filter_var($doctor->user->avatar, FILTER_VALIDATE_URL) ? $doctor->user->avatar : (empty($doctor->user->avatar) ? 'https://via.placeholder.com/300' : asset('storage/' . $doctor->user->avatar)) }}" 
                        alt="{{ $doctor->user->name }}" 
                        class="w-40 h-40 rounded-full border-4 border-indigo-500 shadow-xl transform hover:scale-110 transition duration-300">
                </div>

                <!-- Detalles del doctor -->
                <div class="ml-6 text-center md:text-left">
                    <h2 class="text-2xl font-bold text-indigo-500 group-hover:text-indigo-400 transition duration-300">
                        {{ $doctor->user->name }}
                    </h2>
                    <p class="text-lg text-gray-300">{{ $doctor->specialty }}</p>
                    <p class="text-sm text-gray-400">{{ $doctor->city }}</p>
                    <p class="text-sm text-gray-400 mt-2">
                        <strong>Experiencia:</strong> {{ $doctor->experience_years }} años
                    </p>
                    <p class="text-sm text-gray-400">
                        <strong>Idiomas:</strong> {{ $doctor->languages ?? 'No especificado' }}
                    </p>

                    <!-- Botón para ver más -->
                    <a href="{{ route('doctor.detalle', ['user' => $doctor->user_id]) }}" 
                       class="inline-block mt-4 px-4 py-2 text-sm font-medium text-white bg-indigo-500 rounded-full shadow-md hover:bg-indigo-600 hover:shadow-lg transition duration-300">
                        Ver más detalles
                    </a>
                </div>

                <!-- Icono de interacción -->
                <div class="absolute bottom-2 right-2 text-indigo-500 animate-bounce">
                    <i class="fas fa-user-md text-2xl"></i>
                </div>
            </div>
        @endforeach
    </div>
</div>
