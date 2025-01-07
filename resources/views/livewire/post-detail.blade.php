<div class="container mx-auto p-6 grid grid-cols-1 lg:grid-cols-8 gap-6">
    <!-- Detalle del post -->
    <div class="col-span-1 lg:col-span-6 bg-white dark:bg-gray-900 dark:text-slate-300 p-6 rounded-lg shadow-lg">
        <h1 class="font-bold text-2xl text-gray-800 mb-4 mx-auto  dark:text-slate-300">{{ $post->title }}</h1>
      
        <div class="mb-2">
            <span class="font-semibold text-gray-700 dark:text-slate-300">Categoría:</span>
            <span class="text-gray-800 dark:text-slate-200">{{ $post->category->name }}</span>
        </div>

        <div class="flex items-center text-gray-500 mb-2 dark:text-slate-400">
            <!-- Círculo con iniciales -->
            <div class="flex items-center justify-center w-10 h-10 rounded-full text-white font-bold bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 dark:from-gray-700 dark:via-gray-600 dark:to-gray-500">
                {{ strtoupper(substr($post->user->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $post->user->name)[1] ?? '', 0, 1)) }}
            </div>
            <!-- Nombre del usuario -->
            <span class="ml-3">
                <span>Escrito por:</span>
                <span class="text-gray-800 font-semibold dark:text-slate-200">
                    {{ $post->user->name }}
                    @if ($post->user->doctor)
                        <span class="italic text-blue-500">(Doctor)</span>
                    @endif
                </span>
                <span>•</span>
                <span>{{ $post->created_at->format('d M, Y') }}</span>
            </span>
        </div>

        @if ($post->image)
            <div class="w-full lg:w-1/1 mx-auto mb-6">
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-160 object-cover rounded-lg shadow-md">

            </div>
        @endif

       
        

        <div class="text-gray-700 leading-relaxed dark:text-slate-200 mb-6">
            @php
                // Obtener el contenido
                $content = $post->content;
        
                // Configuración de HTMLPurifier
                $config = HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($config);
        
                // Purificar el contenido
                $sanitizedContent = $purifier->purify($content);
        
                // Determinar si el contenido contiene etiquetas HTML específicas
                $containsHtml = $content !== strip_tags($content);
            @endphp
        
            @if ($containsHtml)
                {{-- Mostrar el contenido como HTML limpio --}}
                {!! $sanitizedContent !!}
            @else
                {{-- Mostrar el contenido como texto plano con saltos de línea --}}
                {{ nl2br(e($sanitizedContent)) }}
            @endif
        </div>
        

        <div class="mt-8 ">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-slate-300">Deja tu reseña</h2>

            @if (session()->has('message'))
                <div class="text-green-500">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="submitReview" class="space-y-4 mt-4">
                <div>
                    <label for="rating" class="block text-gray-700 dark:text-slate-300">Calificación (1-5)</label>
                    <select id="rating" wire:model="rating" class="mt-1 p-2 w-full border dark:bg-gray-900 dark:text-slate-300 border-gray-300 rounded-lg" required>
                        <option value="">Selecciona una calificación</option>
                        <option value="1">1 - Muy malo</option>
                        <option value="2">2 - Malo</option>
                        <option value="3">3 - Regular</option>
                        <option value="4">4 - Bueno</option>
                        <option value="5">5 - Excelente</option>
                    </select>
                    @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="content" class="block text-gray-700 dark:text-slate-300">Tu Reseña</label>
                    <textarea id="content" wire:model="content" rows="4" class="mt-1 p-2 w-full border dark:bg-gray-900 dark:text-slate-300 border-gray-300 rounded-lg" required></textarea>
                    @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg">Enviar Reseña</button>
            </form>
        </div>

        <div>
            <h2 class="text-lg font-bold mb-4">Comentarios</h2>
            @foreach ($comments as $comment)
                <div class="bg-white shadow-md rounded-lg p-4 mb-3 dark:bg-gray-800 dark:text-slate-300">
                    <div class="flex items-center justify-between mb-2">
                        <!-- Sección izquierda: Iniciales y nombre -->
                        <div class="flex items-center">
                            <!-- Círculo con iniciales -->
                            <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full text-white font-bold 
                            bg-gradient-to-r from-cyan-500 via-gray-900 dark:bg-gradient-to-r dark:from-gray-700 dark:via-gray-600 dark:to-gray-500">
                               {{ strtoupper(substr($comment['user']['name'] ?? 'U', 0, 1)) }}{{ strtoupper(substr(explode(' ', $comment['user']['name'] ?? '')[1] ?? '', 0, 1)) }}
                           </div>
                
                            <!-- Nombre del usuario -->
                            <h3 class="ml-3 font-semibold text-gray-800 dark:text-slate-200 text-sm sm:text-base">
                                {{ $comment['user']['name'] ?? 'Usuario Anónimo' }}
                            </h3>
                        </div>
                    
                        <!-- Sección derecha: Fecha -->
                        <span class="text-sm text-gray-500 dark:text-slate-300">
                            {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                        </span>

                        
                    </div>
                    
                    <p class="text-gray-700 dark:text-slate-500">{{ $comment['content'] }}</p>
                    @if ($comment['rating'])
                        <div class="mt-2">
                            <span class="text-yellow-500">★</span> {{ $comment['rating'] }}/5
                        </div>
                    @endif
                </div>
            @endforeach

            @if (count($comments) < $post->messages->count())
            <button wire:click="loadMoreComments" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
                Cargar más comentarios
            </button>
            @endif
        </div>


        <div class="mt-4 text-center">
            <a href="{{ route('blogs.index') }}" class="text-blue-600 hover:underline transition duration-300 ease-in-out">Volver al Blog</a>
        </div>
    </div>

    <!-- Posts relacionados -->
    <div class="col-span-1 lg:col-span-2 bg-gray-50 p-6 dark:bg-gray-900 dark:text-slate-300 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 dark:text-slate-300">Posts Relacionados</h2>

        @forelse ($relatedPosts as $relatedPost)
            <div class="mb-4">
                <a href="{{ route('posts.show', $relatedPost->slug) }}" class="text-blue-600 hover:underline transition duration-300 ease-in-out">
                    {{ $relatedPost->title }}
                </a>
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    {{ $relatedPost->created_at->format('d M, Y') }} por {{ $relatedPost->user->name }}
                </p>
            </div>
        @empty
            <p class="text-gray-500 dark:text-slate-400">No hay posts relacionados.</p>
        @endforelse
    </div>

  

   
</div>
