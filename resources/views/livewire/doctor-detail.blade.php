<div class="space-y-6 bg-white dark:bg-gray-800 p-5 rounded-lg shadow-lg transition-transform transform hover:scale-102 hover:shadow-lg duration-300">
   
 
 

    <!-- Información del Doctor -->
    <section class="flex flex-col md:flex-row items-center md:items-start space-x-6">
        <!-- Foto del Doctor -->
        <div class="relative">
            <img src="{{ filter_var($doctor->user->avatar, FILTER_VALIDATE_URL) ? $doctor->user->avatar : (empty($doctor->user->avatar) ? 'https://via.placeholder.com/300' : asset('storage/' . $doctor->user->avatar)) }}" alt="{{ $doctor->user->name }}" class="w-36 h-36 rounded-full border-4 border-indigo-500 shadow-xl transform hover:scale-105 transition duration-300">
            <div class="absolute top-0 right-0 p-2 bg-indigo-500 rounded-full text-white text-xs font-bold">Verified</div>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col items-center md:items-start text-center md:text-left">
            <h1 class="text-3xl font-extrabold text-indigo-600 dark:text-white mb-2 hover:text-indigo-500 transition-colors">{{ $doctor->user->name }}</h1>
            <p class="text-lg text-indigo-500 dark:text-indigo-400">{{ $doctor->specialty }}</p>
            <p class="text-md text-gray-600 dark:text-gray-300 mt-1">{{ $doctor->city }}</p>
        </div>
    </section>
    

    <!-- Biografía -->
    <section class="py-4">
        <h2 class="text-2xl font-semibold dark:text-white mb-2">Biografía</h2>
        <p class="text-lg text-gray-800 dark:text-gray-200" id="bio-text">{{ $doctor->bio }}</p>
        <button onclick="toggleBio()" class="text-indigo-600 hover:text-indigo-500">Ver más</button>
    </section>

    <!-- Información de Contacto -->
    <section class="space-y-2">
        <h2 class="text-2xl font-semibold dark:text-white mb-2">Información de Contacto</h2>
        <div class="flex items-center space-x-2">
            <i class="fas fa-phone-alt text-indigo-600 dark:text-indigo-400 text-xl"></i>
            <p class="text-gray-600 dark:text-gray-300">Teléfono: <span class="font-medium">{{ $doctor->phone }}</span></p>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-envelope text-indigo-600 dark:text-indigo-400 text-xl"></i>
            <p class="text-gray-600 dark:text-gray-300">Correo: <a href="mailto:{{ $doctor->user->email }}" class="text-blue-500 hover:underline">{{ $doctor->user->email }}</a></p>
        </div>
    </section>
    

    <!-- Certificaciones, Educación y Lenguajes -->
    <section>
        <h2 class="text-2xl font-semibold dark:text-white mb-2">Información Profesional</h2>
        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-2">
            <li><i class="fas fa-certificate text-indigo-500 mr-2"></i><strong>Certificaciones:</strong> {{ $doctor->certifications }}</li>
            <li><i class="fas fa-graduation-cap text-indigo-500 mr-2"></i><strong>Educación:</strong> {{ $doctor->education }}</li>
            <li><i class="fas fa-language text-indigo-500 mr-2"></i><strong>Idiomas:</strong> {{ $doctor->languages }}</li>
            
             <li>
                <i class="fas fa-clock text-indigo-500 mr-2"></i>
                <strong>Horario de consulta:</strong> {{ $doctor->consultation_hours }}
             </li>
        </ul>
    </section>

    <h2 class="text-2xl font-semibold">Mis Certificados</h2>

    <div class="overflow-x-auto mt-4">
        @if ($certificates->isEmpty())
            <div class="text-center text-gray-500 py-4">
                <p>No hay certificados disponibles en este momento.</p>
            </div>
        @else
            <table class="min-w-full border border-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-indigo-500 text-slate-800">
                        <th class="px-4 py-2 text-left font-medium text-gray-300 dark:text-slate-200">Título</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-300 dark:text-slate-200">Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $certificate)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-gray-800 dark:text-slate-200">{{ $certificate->title }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ Storage::url($certificate->file_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700 flex items-center">
                                    <!-- Icono de vista -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 10c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z"></path>
                                    </svg>
                                    Ver PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>



    
    <section>
        <h2 class="text-2xl font-semibold dark:text-white mt-6 mb-2">Logros y Reconocimientos</h2>
        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-2">
            @forelse ($awards as $award)
                <li>
                    <i class="fas fa-trophy text-indigo-500 mr-2"></i>
                    <strong>{{ $award->award_name }}</strong> 
                    otorgado por <em>{{ $award->awarding_institution }}</em> en el año {{ $award->year }}.
                    @if ($award->description)
                        <p class="text-sm text-gray-500 mt-1 ml-6">{{ $award->description }}</p>
                    @endif
                </li>
            @empty
                <li>No hay logros registrados para este doctor.</li>
            @endforelse
        </ul>
    </section>
    
    
    
    <!-- Disponibilidad -->
    <section class="overflow-hidden">
        <h2 class="text-2xl font-semibold dark:text-white mb-2">Disponibilidad</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse (json_decode($doctor->availability, true) ?? [] as $day => $time)
            <div class="flex items-center space-x-2 overflow-hidden">
                <i class="fas fa-calendar-day text-indigo-500"></i>
                <strong class="mr-2">{{ ucfirst($day) }}:</strong>
                <span class="truncate">{{ $time['start'] ?? 'N/A' }} - {{ $time['end'] ?? 'N/A' }}</span>
            </div>
            @empty
            <p>No hay disponibilidad especificada.</p>
            @endforelse
        </div>
    </section>
    <hr>
 
        <h2 class="text-xl font-semibold text-gray-800 mb-4 dark:text-white">Estadísticas de Publicaciones</h2>
        
        @if ($doctor->total_posts === 0)
            <p class="text-center text-lg text-gray-600 dark:text-gray-300">
                Este doctor no tiene publicaciones aún.
            </p>
        @else
            <div class="mb-4 flex items-center">
                <i class="fas fa-newspaper text-indigo-500 mr-2"></i>
                <strong class="text-lg font-medium text-gray-900 dark:text-gray-300">Cantidad de publicaciones:</strong>
                <p class="text-lg text-gray-600 ml-2 dark:text-gray-400">{{ $doctor->total_posts }}</p>
            </div>
            
            <div class="mb-4 flex items-center">
                <i class="fas fa-star text-yellow-400 mr-2"></i>
                <strong class="text-lg font-medium text-gray-900 dark:text-gray-300">Promedio de rating de publicaciones:</strong>
                <p class="text-lg text-gray-600 ml-2 dark:text-gray-400">{{ number_format($doctor->average_post_rating, 1) }}</p>
            </div>
    
            <div class="mb-4 flex items-center">
                <i class="fas fa-folder-open text-green-500 mr-2"></i>
                <strong class="text-lg font-medium text-gray-900 dark:text-gray-300">Categoría más frecuente:</strong>
                <p class="text-lg text-gray-600 ml-2 dark:text-gray-400">{{ $doctor->most_frequent_category ?? 'Sin publicaciones' }}</p>
            </div>
    
            <div class="mb-4 flex items-center">
                <i class="fas fa-clock text-blue-500 mr-2"></i>
                <strong class="text-lg font-medium text-gray-900 dark:text-gray-300">Última publicación:</strong>
                @if ($doctor->latest_post)
                    <a href="{{ route('posts.show', $doctor->latest_post->slug) }}" class="text-lg text-blue-600 ml-2 dark:text-blue-400 hover:underline">
                        {{ $doctor->latest_post->title }}
                    </a>
                @else
                    <p class="text-lg text-gray-600 ml-2 dark:text-gray-400">Sin publicaciones</p>
                @endif
            </div>
            
            
    
            <div class="mb-4 flex items-center">
                <i class="fas fa-comments text-purple-500 mr-2"></i>
                <strong class="text-lg font-medium text-gray-900 dark:text-gray-300">Comentarios totales en sus publicaciones:</strong>
                <p class="text-lg text-gray-600 ml-2 dark:text-gray-400">{{ $doctor->total_comments }}</p>
            </div>
    
            <div class="mb-4 flex items-center">
                <i class="fas fa-thumbs-up text-teal-500 mr-2"></i>
                <strong class="text-lg font-medium text-gray-900 dark:text-gray-300">Publicaciones con alta calificación:</strong>
                <p class="text-lg text-gray-600 ml-2 dark:text-gray-400">{{ $doctor->high_rating_posts_percentage }}%</p>
            </div>
        @endif
 
    
    
    

    <!-- Calificación y Reseñas -->
    <section class="space-y-4">
        <h2 class="text-2xl font-semibold dark:text-white mb-2">Calificaciones</h2>
        <div class="flex items-center space-x-2">
            <p class="text-gray-600 dark:text-gray-300">Promedio de calificación: 
                <span class="text-yellow-500 font-bold">
                    @for ($i = 0; $i < 5; $i++)
                    <i class="fas fa-star {{ $doctor->average_rating >= $i + 1 ? 'text-yellow-500' : 'text-gray-300' }} transform hover:scale-110 hover:text-yellow-400"></i>

                    @endfor
                </span>
            </p>
            <p class="text-gray-600 dark:text-gray-300">({{ $doctor->reviews_count ?? 0 }} reseñas)</p>

        </div>

        <div class="flex items-center space-x-2 mt-4">
             
        @if (auth()->check() && auth()->user()->hasRole('patient'))
            <button 
            wire:click="likeDoctor" 
            class="focus:outline-none transition duration-300 ease-in-out transform hover:scale-110"
            aria-label="Like Doctor"
           >
            @if ($liked)
                <!-- Icono activo -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 transition" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            @else
                <!-- Icono inactivo -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 010-6.364 4.5 4.5 0 016.364 0L12 2.682l1.318-1.318a4.5 4.5 0 016.364 6.364L12 16.682l-7.682-7.682z" />
                </svg>
            @endif
            </button>
        @endif

            <span class="text-sm font-medium text-gray-700">{{ $likesCount }} Me gusta</span>
        
        </div>
        <hr>
        @if (session()->has('message'))
        <div class="text-green-500 mt-4">
         {{ session('message') }}
        </div>

        @endif
    
        @if (session()->has('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
          {{ session('error') }}
        </div>
        @endif

        <div class="space-y-6 p-5  transition-transform transform hover:scale-102 hover:shadow-lg duration-300">
           
         
        
            <!-- Modal de Agendar Cita -->
            @if($isModalOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                    <!-- Título del modal -->
                    <h3 class="text-2xl font-semibold text-indigo-600">Agendar cita con Dr. {{ $doctor->user->name }}</h3>
                    <form wire:submit.prevent="submitAppointment">
                        <!-- Aquí puedes agregar campos para seleccionar fecha y hora -->
                        <div class="mt-4">
                            <label for="appointment_datetime" class="block text-gray-700 dark:text-gray-600">Fecha y hora de cita</label>
                            <input type="datetime-local" id="appointment_datetime" wire:model="appointment_datetime" class="mt-2 p-2 w-full border dark:bg-indigo-400 border-gray-300 rounded-md">
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-all duration-300 shadow-lg">
                                Confirmar cita
                            </button>
                        </div>
                    </form>
        
                    <!-- Botón de cerrar el modal -->
                    <button wire:click="toggleModal" class="mt-4 text-red-500">Cerrar</button>
                </div>
                <br>
                @if (session()->has('message'))
                <div class="text-green-500 mt-4">
                 {{ session('message') }}
                </div>
    
                @endif
                
                @if (session()->has('error'))
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                  {{ session('error') }}
                </div>
                @endif
                </div>
            </div>
            @endif
        
         
        </div>
        
        @if (auth()->check() && auth()->user()->hasRole('patient'))
        <div class="mt-4">
            <form wire:submit.prevent="submitRating">
         
               <label for="rating" class="block text-gray-700 dark:text-gray-300">Califica al doctor:</label>
               <select id="rating" wire:model="rating" class="dark:bg-cyan-900 block w-full max-w-xs sm:max-w-full p-2 rounded-md border border-gray-300">
                   <option value="" selected disabled>Seleccionar o Calificar</option>
                   @for ($i = 1; $i <= 5; $i++)
                       <option value="{{ $i }}">{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                   @endfor
               </select>
   
               <label for="review" class="block text-gray-700 dark:text-gray-300 mt-4">Escribe una reseña (opcional):</label>
               <textarea id="review" wire:model="review" class=" dark:bg-cyan-900 block w-full p-2 rounded-md border border-gray-300" placeholder="Comparte tu experiencia..."></textarea>
   
               <button type="submit" class="mt-4 bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-all duration-300 shadow-lg">
                   <i class="fas fa-paper-plane mr-2"></i> Enviar Calificación
               </button>
               
             </form>
             <br>
          
           </div>
           @endif
    </section>
    
    

    
    
    <section class="space-y-4">
        <h2 class="text-2xl font-semibold dark:text-white mb-2">Reseñas</h2>
        @foreach ($reviews as $review)
      <div class="p-4 border rounded-lg bg-gray-100 dark:bg-gray-800 shadow-md hover:scale-102 transition-transform">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $review['user']['name'] ?? 'Anónimo' }} - {{ \Carbon\Carbon::parse($review['created_at'])->format('d M Y') }}
        </p>
        
        <!-- Reseña con texto expandible -->
        <p id="review-{{ $review['id'] }}" class="text-lg text-gray-800 dark:text-gray-200 line-clamp-3">
            {{ $review['review'] }}
        </p>

        <!-- Botón para expandir/reducir texto -->
        <button onclick="toggleReview({{ $review['id'] }})" class="text-indigo-600 hover:text-indigo-500 mt-2">
            Ver más
        </button>

        <!-- Rating de estrellas -->
        <div class="flex items-center mt-2">
            @for ($i = 0; $i < 5; $i++)
                <i class="fas fa-star {{ $review['rating'] >= $i + 1 ? 'text-yellow-500' : 'text-gray-300' }}"></i>
            @endfor
        </div>
    </div>
     @endforeach


    
        @if (count($reviews) < $doctor->reviews_count)
        <button wire:click="loadMoreReviews" class="bg-indigo-500 text-white px-6 py-3 rounded-full hover:bg-indigo-600 transition-transform transform hover:scale-105 duration-300">
            Ver más reseñas
        </button>
        @endif
    </section>
    

    <!-- Botón de regreso -->
    <div class="mt-6">
        <a href="{{ route('doctores.index') }}" class="mt-6 bg-gray-500 text-white px-6 py-3 rounded-full hover:bg-gray-600 transition-colors shadow-md flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
        </a>
        
    </div>

    <div>
        <h2 class="text-2xl font-medium font-semibold mb-1">Publicaciones del doctor</h2>
        <ul>
            @forelse ($posts as $post)
                <li class="mb-2">
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500 hover:underline">
                        <i class="fas fa-newspaper mr-2"></i> {{ $post->title }}
                    </a>
                </li>
            @empty
                <p>Este doctor aún no tiene publicaciones.</p>
            @endforelse
        </ul>
    
        @if ($posts->count() >= $this->perPage)
            <button wire:click="loadMore" class="mt-4 bg-blue-800 text-white py-2 px-4 rounded hover:bg-blue-900">
                Cargar más
            </button>
        @endif
    </div>

    <div>
        @if (auth()->check() && auth()->user()->hasRole('patient')) 
        <!-- Validación de autenticación y rol -->
        <h2 class="text-2xl font-medium font-semibold">Doctores relacionados</h2>
        <livewire:related-doctors :doctorId="$doctor->id" />
    @else
        <!-- Mensaje opcional para usuarios no autenticados o sin el rol -->
        <p class="text-red-500"></p>
    @endif
    
    </div>
    
    


    <div>
       
      
        
    </div>
    
</div>
