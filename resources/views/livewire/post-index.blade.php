<div  class="space-y-6">
    <!-- Filtros -->
    <div class="flex flex-wrap gap-6 items-center justify-between p-4 dark:bg-gradient-to-br dark:from-green-500 dark:via-blue-700 dark:to-black rounded-2xl p-6 shadow-lg w-full">
        <!-- Campo de búsqueda -->
        <div class="flex items-center bg-white rounded-full shadow-lg p-2 w-full sm:w-auto">
            <i class="fas fa-search text-gray-500 mr-2"></i>
            <input 
                type="text" 
                wire:model.defer="tempSearch" 
                placeholder="Buscar publicaciones..."
                class="border-0 rounded-full px-4 py-2 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Select para categoría -->
        <div class="relative">
            <select 
                wire:model.defer="tempCategory" 
                class="block w-full sm:w-64 px-4 py-2 rounded-md dark:bg-gray-800 dark:text-gray-200 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para aplicar filtros -->
        <button 
            wire:click="applyFilters" 
            class="bg-blue-600 dark:bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">
            <i class="fas fa-search mr-2"></i> Buscar
        </button>
    </div>

 <!-- Listado de publicaciones -->
 <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sección de Publicaciones (Principal) -->
    <div  class="lg:col-span-2   duration-300 ease-in-out p-6">
        @forelse ($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out p-6 mb-6">
                <div class="flex flex-col lg:flex-row justify-between h-full">
                    <!-- Imagen destacada -->
                    @if ($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full lg:w-1/3 h-48 object-cover rounded-lg mb-6 lg:mb-0 lg:mr-6">
                    @endif
                       <div class="lg:w-2/3">
                        <!-- Título del post -->
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 hover:text-blue-600 transition-colors duration-200 mb-4">
                            {{ $post->title }}
                        </h2>
                    
                        <!-- Información del post en una fila -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-center mb-4">
                            <!-- Autor -->
                            <p class="text-sm text-blue-500 font-medium flex items-center">
                                <i class="fas fa-user mr-2"></i>{{ $post->user->name }}
                            </p>
                            <!-- Categoría -->
                            <p class="text-sm text-blue-500 font-medium flex items-center">
                                <i class="fas fa-tag mr-2"></i>{{ $post->category->name }}
                            </p>
                            <!-- Fecha del post -->
                            <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <i class="fas fa-calendar-day mr-2"></i>{{ $post->created_at->format('d M Y') }}
                            </p>
                        </div>
                    
                        <!-- Detalles adicionales en una fila -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center mb-4">
                            <!-- Total de mensajes -->
                            <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <i class="fas fa-comments mr-2"></i>{{ $post->total_messages }} mensajes
                            </p>
                            <!-- Promedio de calificación -->
                            <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <i class="fas fa-star mr-2"></i>{{ number_format($post->average_rating, 1) }} / 5
                            </p>
                        </div>
                    
                        <!-- Resumen del contenido -->
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            @php
                            // Limitar el contenido
                            $content = Str::limit($post->content, 100);
                        
                            // Configuración de HTMLPurifier
                            $config = HTMLPurifier_Config::createDefault();
                            $purifier = new HTMLPurifier($config);
                        
                            // Purificar el contenido
                            $sanitizedContent = $purifier->purify($content);
                        @endphp
                        
                    
                            {!! $sanitizedContent !!}
                        </p>
                        
                    
                    
                        <!-- Botón para leer más -->
                        <a href="{{ route('posts.show', $post->slug) }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out">
                            <i class="fas fa-info-circle mr-2"></i> Leer más
                        </a>
                    </div>
                    
                    
                    
                </div>
            </div>
        @empty
            <!-- Mensaje cuando no hay resultados -->
            <p class="col-span-3 text-center text-gray-600 dark:text-gray-300 py-6 text-lg">
                No se encontraron publicaciones con los criterios seleccionados.
            </p>
        @endforelse
         <!-- Paginación -->
     <div class="mt-6 mb-4">
        {{ $posts->links() }}
    </div>

    <livewire:category-card />

    </div>
    
    <!-- Sección de Post Más Vistos (Con menor ancho) -->
    <div class="  p-6 mt-6">
        <!-- Título -->
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl fs-1 font-semibold text-gray-800 dark:text-gray-100">
                <i class="fas fa-chart-line text-blue-600 mr-2"></i> Articulos Más Vistos y mejor Calificados.
            </h1>
           
        </div>
        
        <!-- Lista de posts populares -->
        <ul>
            @forelse ($popularPosts as $popularPost)
                <li class="mb-6 p-2">
                    <div class="flex items-start gap-4">
                        <!-- Imagen del post -->
                        @if ($popularPost->image)
                            <img src="{{ Storage::url($popularPost->image) }}" alt="{{ $popularPost->title }}" class="w-16 h-16 object-cover rounded-md shadow">
                        @else
                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-md shadow">
                                <i class="fas fa-image text-gray-500 text-xl"></i>
                            </div>
                        @endif
    
                        <!-- Información del post -->
                        <div>
                            <a href="{{ route('posts.show', $popularPost->slug) }}" class="text-lg font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 transition-colors duration-200">
                                {{ $popularPost->title }}
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <i class="fas fa-calendar-alt text-blue-500 mr-1"></i>
                                {{ $popularPost->created_at->format('d M Y') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <i class="fas fa-eye text-blue-500 mr-1"></i> {{ $popularPost->views }} vistas
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <i class="fas fa-comments text-blue-500 mr-1"></i> {{ $popularPost->messages_count ?? 0 }} comentarios
                            </p>
                        </div>
                    </div>
    
                    <!-- Botón para leer más -->
                    <div class="mt-3">
                        <a href="{{ route('posts.show', $popularPost->slug) }}" class="inline-block text-sm text-white bg-blue-600 py-2 px-4 rounded-md hover:bg-blue-700 transition-all">
                            Leer más <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </li>
                <hr>
            @empty
                <!-- Mensaje cuando no hay posts populares -->
                <p class="text-sm text-gray-600 dark:text-gray-400">No hay publicaciones populares.</p>
                
            @endforelse
           
        </ul>

               <br>
               @if(Auth::check())
               <div class="bg-gradient-to-br from-blue-600 to-indigo-500 rounded-xl p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                   <div class="flex items-center justify-between mb-4">
                       <span class="bg-gray-700 text-white text-xs px-3 py-1 rounded-full">Salud</span>
                       <span class="text-sm text-gray-300">20/12/2024</span>
                   </div>
                   <h3 class="text-xl font-bold mb-4 text-white">¿Qué temas te gustaría que los profesionales abordaran?</h3>
                   <p class="text-gray-200 mb-4">Déjanos tu sugerencia para que podamos mejorar nuestra plataforma y ayudarte mejor.</p>
                   
                   <form wire:submit.prevent="submitSuggestion" class="mt-4">
                       <div class="space-y-4">
                           <div>
                               <textarea wire:model="suggestion" 
                                         class="w-full dark:text-slate-700 p-4 border border-gray-300 rounded-lg @error('suggestion') border-red-500 @enderror" 
                                         placeholder="Escribe tu sugerencia aquí..." 
                                         rows="4">
                               </textarea>
                               @error('suggestion') 
                                   <p class="bg-slate-300 text-red-500 text-sm mt-1">{{ $message }}</p> 
                               @enderror
                           </div>
                           <input type="hidden" wire:model="userEmail" value="{{ auth()->user()->email }}">
                       </div>
                       
                       <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg mt-4">
                           Enviar Sugerencia
                       </button>
                   </form>
                   
                   @if (session()->has('success'))
                       <div class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4">
                           {{ session('success') }}
                       </div>
                   @endif
               </div>
           @else
               <p class="text-gray-600">Debes <a href="{{ route('login') }}" class="text-blue-800 underline">iniciar sesión</a> para dejar una sugerencia.</p>
           @endif
           

            
            <br>
            <div class="bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-gray-700 text-white text-xs px-3 py-1 rounded-full">Recurso</span>
                    <span class="text-sm text-gray-300">Disponible ahora</span>
                </div>
                <h3 class="text-xl font-bold mb-4 text-white">Guía gratuita: Cómo mejorar tu alimentación</h3>
                <p class="text-gray-200 mb-4">Descarga nuestra guía gratuita con recetas saludables y consejos prácticos para el día a día.</p>
                <button class="bg-gray-800 text-white py-2 px-4 rounded-lg mt-4 hover:bg-gray-700">Descargar ahora</button>
            </div>
            <br>

            <div class="bg-gradient-to-br from-red-600 to-yellow-500 rounded-xl p-6 shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-gray-700 text-white text-xs px-3 py-1 rounded-full">Evento</span>
                    <span class="text-sm text-gray-300">10/01/2025</span>
                </div>
                <h3 class="text-xl font-bold mb-4 text-white">Taller: Mejora tu salud con expertos</h3>
                <p class="text-gray-200 mb-4">Únete a nosotros para un taller interactivo con profesionales de la salud. Cupos limitados.</p>
                <button class="bg-gray-800 text-white py-2 px-4 rounded-lg mt-4 hover:bg-gray-700">Regístrate ahora</button>
            </div>
           <br>
          
           <livewire:category-carousel />
        
            
            
            


      
    </div>
    
</div>


   
</div>
