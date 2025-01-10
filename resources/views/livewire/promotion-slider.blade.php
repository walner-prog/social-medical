<div class="">
    <!-- Header -->
    <header class="text-center py-12 dark:text-slate-50 text-slate-100   bg-gradient-to-b from-indigo-900 via-indigo-800 to-indigo dark:bg-gradient-to-b from-gray-900 via-gray-800 to-black">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between space-y-8 lg:space-y-0 ">
            <!-- Sección izquierda -->
            <div class="p-6 w-full lg:w-1/4 text-center transform transition-transform hover:scale-105 relative">
                <!-- Icono de estrella fugaz -->
                <div class="relative flex justify-center mb-4">
                    <i class="fas fa-meteor text-yellow-400 text-4xl animate-spin-slow"></i>
                    <!-- Estela de la estrella -->
                    <div class="absolute -bottom-2 h-6 w-1 bg-yellow-300 blur-md opacity-50 animate-pulse"></div>
                </div>
                <h3 class="text-2xl font-bold text-blue-400">Beneficio Adicional</h3>
                <p class="mt-4 text-sm text-gray-400">Explora características únicas diseñadas para ti.</p>
            </div>
            
    
            <!-- Sección central -->
            <div class="lg:w-1/2">
                <!-- Subtítulo con icono y texto -->
                <p class="text-lg dark:text-gray-300 flex items-center justify-center space-x-4">
                    <!-- Icono representativo de suscripción -->
                    <i class="fas fa-gift text-blue-500 text-2xl"></i>
                    
                    <!-- Texto mejorado -->
                    <span>
                        Regálate una suscripción a un precio especial y actualiza tus habilidades técnicas.
                    </span>
                </p>
                
                <!-- Beneficios adicionales con iconos -->
                <div class="mt-6 space-y-4">
                    <!-- Beneficio 1 -->
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fas fa-check-circle text-blue-500 text-lg"></i>
                        <span class="text-sm text-gray-400">Acceso a contenido exclusivo para miembros</span>
                    </div>
                    
                    <!-- Beneficio 2 -->
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fas fa-clock text-blue-500 text-lg"></i>
                        <span class="text-sm text-gray-400">Aprende a tu propio ritmo, sin presiones</span>
                    </div>
                    
                    <!-- Beneficio 3 -->
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fas fa-certificate text-blue-500 text-lg"></i>
                        <span class="text-sm text-gray-400">Obtén certificados al completar los cursos</span>
                    </div>
                </div>
            </div>
    
            <!-- Sección derecha -->
            <div class="p-6 w-full lg:w-1/4 text-center transform transition-transform hover:scale-105 relative">
                <!-- Icono de nave volando -->
                <div class="relative flex justify-center mb-4">
                    <i class="fas fa-space-shuttle text-blue-500 text-4xl animate-bounce"></i>
                    <!-- Estela de la nave -->
                    <div class="absolute -bottom-2 h-8 w-1 bg-blue-400 blur-md opacity-50 animate-pulse"></div>
                </div>
                <h3 class="text-2xl font-bold text-blue-400">Más Información</h3>
                <p class="mt-4 text-sm text-gray-400">Consulta nuestras ofertas especiales y suscríbete hoy.</p>
            </div>
            
            
        </div>
    </header>
    

    <!-- Contenedor principal -->
    <div class="container mx-auto px-4 lg:px-8 ">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Slider de Promociones (Fijo) -->
            <div class="space-y-6 sticky top-0 mt-8">

                <h2 class="text-3xl font-bold text-blue-700 dark:text-slate-200">Promociones y Ofertas</h2>
                <div class="relative overflow-x-auto snap-x snap-mandatory flex space-x-6 pb-6">
                    @foreach ($promotions as $promotion)
                        <div
                            class="snap-center bg-gradient-to-r from-purple-600 via-indigo-500 to-teal-500 p-8 rounded-lg shadow-lg text-white flex-none w-96">
                            <h3 class="text-xl font-bold">{{ $promotion->title }}</h3>
                            <p class="mt-2 text-sm text-gray-200">{{ $promotion->description }}</p>
                            <div class="mt-4">
                                <span class="block text-yellow-300 text-lg font-semibold">
                                    Precio Especial: C${{ $promotion->discounted_price }}
                                </span>
                                <span class="line-through text-sm text-gray-400">
                                    Antes: C${{ $promotion->original_price }}
                                </span>
                            </div>
                            <div class="mt-6">
                                <button
                                    class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-full shadow-md transition transform hover:scale-105">
                                    Suscríbete
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Publicaciones con Scroll Independiente -->
            <div class="space-y-8 max-h-[500px] overflow-y-auto scrollbar-hidden p-8">
                <h2 class="text-3xl font-bold text-blue-700 dark:text-slate-200 transition-transform transform hover:scale-105">Aprende de forma profesional a:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($posts as $post)
                        <div class="bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition transform hover:scale-105">
                            @if ($post->image)
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg mb-6">
                            @endif
                            <h4 class="text-xl font-semibold text-yellow-400">{{ $post->title }}</h4>
                          
                            <div class="mt-4">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-300 text-sm font-bold hover:underline">
                                    Leer más
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            
                <!-- Sección de Promociones y Ofertas -->
                <h2 class="text-4xl font-bold text-blue-400 dark:text-slate-200 transition-transform transform hover:scale-105 mt-12">Promociones y Ofertas</h2>
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                    <!-- Sección 1 -->
                    <div class="bg-gray-800 p-8 rounded-xl shadow-lg text-center transform transition-transform hover:scale-105 hover:bg-sky-800 hover:text-white">
                        <div class="text-5xl text-blue-500 mb-4 animate__animated animate__fadeIn">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-400">Desarrollo Profesional</h3>
                        <p class="mt-4 text-gray-400">Mejora tus habilidades técnicas con nuestras promociones y cursos exclusivos.</p>
                    </div>
            
                    <!-- Sección 2 -->
                    <div class="bg-gray-800 p-8 rounded-xl shadow-lg text-center transform transition-transform hover:scale-105 hover:bg-sky-800 hover:text-white">
                        <div class="text-5xl text-blue-500 mb-4 animate__animated animate__fadeIn">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-400">Comunidad de Aprendizaje</h3>
                        <p class="mt-4 text-gray-400">Únete a una comunidad vibrante y comparte conocimientos con otros profesionales.</p>
                    </div>
            
                    <!-- Sección 3 -->
                    <div class="bg-gray-800 p-8 rounded-xl shadow-lg text-center transform transition-transform hover:scale-105 hover:bg-sky-800 hover:text-white">
                        <div class="text-5xl text-blue-500 mb-4 animate__animated animate__fadeIn">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-400">Avanza tu carrera</h3>
                        <p class="mt-4 text-gray-400">Transforma tu futuro con herramientas y recursos que te preparan para lo mejor.</p>
                    </div>
                </div>
            
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-1 gap-12">
                    <div class="mt-12 bg-gray-800 p-8 rounded-xl shadow-lg text-center transform transition-transform hover:scale-105 hover:bg-sky-900 hover:text-white">
                        <h5 class="text-xl font-semibold text-blue-500">Social Medical: Una plataforma integral</h5>
                        <p class="mt-4 text-gray-400">
                            Con Social Medical, no solo tienes acceso a promociones educativas, sino que también cuentas con una plataforma de aprendizaje interactiva.
                        </p>
                        <span class="block mt-4 text-sm text-gray-500">Conéctate con profesionales de la salud y mejora tus habilidades en cualquier momento.</span>
                    </div>
                </div>
            </div>
            

            
           

        </div>
    </div>

    
</div>
