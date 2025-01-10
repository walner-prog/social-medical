<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>medical Social</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <div class="">
            
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </header>
    
                    <div  class="min-h-screen bg-gradient-to-br from-gray-900 to-blue-900 text-white flex flex-col max-w-12xl mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
                 
                        @if(session('success'))
                        <div class="alert alert-success text-center aler">
                            {{ session('success') }}
                        </div>
                        @endif
                    
                        @if(session('error'))
                        <div class="alert alert-danger text-center bg-red-400">
                            {{ session('error') }}
                        </div>
                       @endif
                
                       {{--  Notificaciones de usuarioas nuevos registrados  --}}
                       @if (session()->has('notification'))
                         @php
                          $notification = session('notification');
                          @endphp
                
                            <div x-data="{ show: true }" x-show="show" class="p-4 bg-blue-100 text-blue-700 rounded relative">
                            <p>{{ $notification['message'] }}</p>
                
                           <!-- Botón para cerrar la notificación -->
                           <button @click="show = false" class="absolute top-2 right-2 text-xl">
                            &times;
                            </button>
                            </div>
                      @endif
                
                            
                            
                        <!-- Hero Section -->
                        <section data-aos="fade-up"
                           data-aos-duration="1000"data-aos-once="true"
                           class="flex flex-col md:flex-row items-center justify-between px-4 md:px-8 py-8 md:py-16 space-y-8 md:space-y-0">
                            <!-- Contenido principal -->
                            <div class="max-w-lg text-center md:text-left">
                                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">
                                    Mejora tu Salud con <span class="text-yellow-400">Social Medical</span>
                                </h1>
                                <p class="text-base md:text-lg text-gray-300 mb-6">
                                    Conecta con médicos de confianza y administra tu salud con facilidad. Únete a miles de usuarios que encuentran los mejores especialistas en nuestra plataforma.
                                </p>
                                <a href="{{ route('register') }}" 
                                class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 md:px-6 md:py-3 rounded-lg text-base md:text-lg shadow-lg transition duration-300 ease-in-out transform hover:bg-yellow-500 hover:scale-105 hover:rotate-[360deg] hover:shadow-xl">
                                <span class="absolute inset-0 flex justify-center items-center opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100">
                                    <div class="spark spark-delay-1"></div>
                                         
                                     <div class="spark spark-delay-2"></div>
                                     <div class="spark spark-delay-3"></div>
                                     <div class="spark spark-delay-4"></div>
                                    
                                     <div class="spark spark-delay-5"></div>
                                    
                                 </span>
                                 Abrir Cuenta
                             </a>
                             
                            </div>
                    
                            <!-- Imagen y Datos -->
                            <div class="relative w-full md:w-1/2 p-6 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-xl shadow-lg">
                                <!-- Título llamativo -->
                                <h2 class="text-3xl font-bold text-white mb-4">
                                    ¡Transforma tu Salud Hoy Mismo!
                                </h2>
                                
                                <!-- Descripción -->
                                <p class="text-lg text-gray-100 mb-6">
                                    Con nuestra plataforma, accede a médicos especialistas, consulta en línea, y mejora tu bienestar de manera fácil y segura. ¡Comienza ahora!
                                </p>
                                
                                <!-- Botón atractivo para acción -->
                                <a href="{{ route('register') }}" 
                                class="relative inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg text-lg font-semibold shadow-lg transition duration-500 ease-in-out transform hover:bg-yellow-500 hover:scale-105 hover:rotate-[360deg] hover:shadow-xl">
                             
                                 <!-- Chispas dentro del botón -->
                                 <span class="absolute inset-0 flex justify-center items-center opacity-0 transition-opacity duration-300 ease-in-out hover:opacity-100">
                                    <div class="spark spark-delay-1"></div>
                                         
                                     <div class="spark spark-delay-2"></div>
                                     <div class="spark spark-delay-3"></div>
                                     <div class="spark spark-delay-4"></div>
                                    
                                     <div class="spark spark-delay-5"></div>
                                    
                                 </span>
                             
                                 ¡Únete a Social Medical!
                                 </a>
                
                             
                             
                             
                            
                                <!-- Imagen o icono decorativo (opcional) -->
                                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 -translate-x-12">
                                    <i class="fas fa-heartbeat text-white text-4xl md:text-5xl animate-heartbeat"></i> <!-- Icono de salud -->
                                </div>
                                
                                
                            </div>
                            
                            
                        </section>
                    
                        <!-- Cards y Texto Adicional -->
                        <section data-aos="fade-up"
                                 data-aos-duration="1000"data-aos-once="true" class="flex flex-col lg:flex-row items-center lg:justify-between px-4 md:px-8 py-8 md:py-16 space-y-8 lg:space-y-0">
                            <!-- Tarjetas -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
                                <!-- Tarjeta 1 -->
                                <div class="bg-gradient-to-br from-teal-500 to-green-400 rounded-xl p-6 shadow-lg flex flex-col items-center">
                                    <div class="text-white text-sm font-semibold">Especialidades</div>
                                    <div class="mt-4 text-white text-lg font-bold">+25 Categorías</div>
                                    <div class="mt-2 text-white text-4xl font-extrabold">Confianza</div>
                                    <div class="mt-4 text-white text-sm">Médicos reconocidos por su experiencia y atención.</div>
                                    <!-- Icono en la tarjeta -->
                                    <div class="mt-6 text-white text-6xl animate-pulse transition-transform transform hover:translate-y-2">
                                        <i class="fas fa-briefcase-medical"></i>
                                    </div>
                                </div>
                            
                                <!-- Tarjeta 2 -->
                                <div class="bg-gradient-to-br from-yellow-400 to-orange-300 rounded-xl p-6 shadow-lg flex flex-col items-center">
                                    <div class="text-gray-800 text-sm font-semibold">Búsqueda Avanzada</div>
                                    <div class="mt-4 text-gray-800 text-4xl font-extrabold">Fácil y Rápida</div>
                                    <div class="mt-2 text-gray-800 text-sm font-semibold">+50 Ciudades Disponibles</div>
                                    <div class="mt-4 text-gray-800 text-sm">Encuentra médicos según ciudad, especialidad o experiencia.</div>
                                    <!-- Icono en la tarjeta -->
                                    <div class="mt-6 text-gray-800 text-6xl animate-pulse transition-transform transform hover:translate-y-2">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            
                                <!-- Tarjeta 3 -->
                                <div class="bg-gradient-to-br from-purple-500 to-indigo-400 rounded-xl p-6 shadow-lg flex flex-col items-center">
                                    <div class="text-white text-sm font-semibold">Blog de Salud</div>
                                    <div class="mt-4 text-white text-lg font-bold">Consejos y Tips</div>
                                    <div class="mt-2 text-white text-4xl font-extrabold">Actualizados</div>
                                    <div class="mt-4 text-white text-sm">Explora artículos sobre bienestar, cuidados médicos y tendencias en salud.</div>
                                    <!-- Icono en la tarjeta -->
                                    <div class="mt-6 text-white text-6xl animate-pulse transition-transform transform hover:translate-y-2">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                </div>
                            
                                <!-- Tarjeta 4 -->
                                <div class="bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl p-6 shadow-lg flex flex-col items-center">
                                    <div class="text-white text-sm font-semibold">Conoce Más</div>
                                    <div class="mt-4 text-white text-lg font-bold">Plataforma Segura</div>
                                    <div class="mt-2 text-white text-4xl font-extrabold">Confiable</div>
                                    <div class="mt-4 text-white text-sm">Descubre cómo *Social Medical* puede transformar tu experiencia en salud.</div>
                                    <!-- Icono en la tarjeta -->
                                    <div class="mt-6 text-white text-6xl animate-pulse transition-transform transform hover:translate-y-2">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Texto Lateral -->
                            <div class="w-full lg:w-1/3 text-center lg:text-left p-4">
                                <div class="mb-10">
                                    <h2 class="text-4xl font-bold">Conecta con <span class="text-teal-400">Especialistas</span></h2>
                                    <p class="text-lg">Accede a una red confiable y profesional.</p>
                                    <ul class="mt-4 text-sm">
                                        <li>Médicos Certificados</li>
                                        <li>Variedad de Especialidades</li>
                                        <li>Confianza Garantizada</li>
                                    </ul>
                                </div>
                                <div>
                                    <h2 class="text-4xl font-bold">Usa Herramientas <span class="text-yellow-400">Avanzadas</span></h2>
                                    <p class="text-lg">Facilita la gestión de tu salud.</p>
                                    <ul class="mt-4 text-sm">
                                        <li>Búsqueda Inteligente</li>
                                        <li>Perfiles Detallados</li>
                                        <li>Soporte 24/7</li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>


         </div>

         <div class="bg-gradient-to-b from-[#0F1020] to-[#1B1D35] min-h-screen flex items-center justify-center py-10 px-4">
            <div class="max-w-5xl w-full bg-opacity-80 p-6 rounded-xl shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                  <!-- Contenido Izquierdo -->
                  <div class="space-y-6 ">
                    <h1 class="text-white text-4xl font-bold leading-tight">Descubre y publica en el blog: Fácil y rápido</h1>
                    <p class="text-gray-300 text-lg">Un espacio creado especialmente para que los médicos compartan conocimientos, experiencias y consejos de salud con los usuarios. Busca contenido por especialidad, ciudad o temas populares.</p>
                    <p class="text-gray-300 text-lg">Nuestro objetivo es facilitar la gestión de publicaciones y permitir a los médicos llegar a un público más amplio mientras enriquecen la plataforma con contenido útil y educativo.</p>
                    <a href="{{ route('blogs.index') }}" class="inline-block bg-blue-900 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105">Explorar el Blog</a>
                  </div>
              
                  <!-- Contenido Derecho -->
                  <div class="relative">
                    <div class="bg-[#1D2237]  rounded-xl shadow-lg">
                      <div class="flex justify-between mb-4 text-gray-400 p-2">
                        <button class="px-3 py-1 mr-2 rounded bg-gray-700 text-gray-300 flex items-center gap-2">
                          <i class="fas fa-pen"></i> Crear Post
                        </button>
                        <button class="px-3 py-1 mr-1 rounded bg-gray-700 text-gray-300 flex items-center gap-2">
                          <i class="fas fa-folder-open"></i> Mis Publicaciones
                        </button>
                        <button class="px-3 py-1 mr-1   rounded bg-gray-700 text-gray-300 flex items-center gap-2">
                          <i class="fas fa-search"></i> Buscar Post
                        </button>
                      </div>
                  
                      <!-- Información sobre el Blog -->
                      <div class="bg-[#1A1D2E] p-4 rounded-lg text-white text-sm">
                        <p>
                          Nuestro blog te permite <span class="text-blue-700 font-semibold">crear</span> y <span class="text-blue-700 font-semibold">gestionar publicaciones</span> fácilmente. Puedes organizar tus contenidos por temas de interés y alcanzar un mayor público.
                        </p>
                        <p class="mt-4">
                          Con herramientas simples e intuitivas, puedes buscar contenido o compartir artículos médicos con solo unos clics. ¡Empieza a explorar ahora!
                        </p>
                      </div>
                    </div>
                  
                    <!-- Iconos de Font Awesome -->
                    <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                      <div class="flex flex-col items-center animate-bounce">
                        <i class="fas fa-pencil-alt text-blue-700 text-3xl"></i>
                        <span class="text-gray-300 mt-2">Escribir</span>
                      </div>
                      <div class="flex flex-col items-center animate-spin">
                        <i class="fas fa-search text-blue-700 text-3xl"></i>
                        <span class="text-gray-300 mt-2">Buscar</span>
                      </div>
                      <div class="flex flex-col items-center animate-pulse">
                        <i class="fas fa-share-alt text-blue-700 text-3xl"></i>
                        <span class="text-gray-300 mt-2">Compartir</span>
                      </div>
                    </div>
                  </div>
                  
                </div>
              
                <!-- Sección Inferior -->
                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-10 text-center">
                  <div class="space-y-4">
                    <div class="bg-gray-700 p-4 rounded-lg inline-block">
                      <span class="text-white text-2xl">Tipos de Búsqueda</span>
                    </div>
                    <p class="text-gray-300">Encuentra contenido relevante según especialidad médica, ciudad o temas de interés específicos.</p>
                  </div>
              
                  <div class="space-y-4">
                    <div class="bg-gray-700 p-4 rounded-lg inline-block">
                      <span class="text-white text-2xl">Fácil de Usar</span>
                    </div>
                    <p class="text-gray-300">Los médicos pueden crear, editar y gestionar publicaciones de manera intuitiva y rápida.</p>
                  </div>
                </div>
              </div>
              
         </div>

        
         <livewire:doctor-showcase />  
        
          
        <div class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 min-h-screen py-10 text-white">
            <div class="text-center">
              <h1 class="text-4xl font-bold mb-4">Usuarios Registrados</h1>
              <p class="text-gray-400">Resumen de usuarios registrados por fechas recientes.</p>
            </div>
          
            <div class="relative max-w-4xl mx-auto mt-12">
              <!-- Timeline Line -->
              <div class="absolute top-0 left-1/2 -translate-x-1/2 h-full w-1 bg-gradient-to-b from-indigo-500 to-purple-500"></div>
          
              @foreach ($usersTimeline as $date => $usersCount)
                <!-- Timeline Item -->
                <div class="relative mb-12">
                  <div class="flex items-center {{ $loop->index % 2 == 0 ? 'justify-start' : 'justify-end' }}">
                    @if ($loop->index % 2 == 0)
                      <div class="w-1/2 pr-8 text-right">
                        <p class="text-indigo-400 text-sm">{{ $date }}</p>
                        <h3 class="text-2xl font-semibold">Usuarios Registrados</h3>
                        <p class="text-gray-300 mt-2">Total: {{ $usersCount }} usuarios.</p>
                      </div>
                      <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full shadow-lg">
                        <span class="text-lg font-bold">{{ $loop->iteration }}</span>
                      </div>
                    @else
                      <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full shadow-lg">
                        <span class="text-lg font-bold">{{ $loop->iteration }}</span>
                      </div>
                      <div class="w-1/2 pl-8 text-left">
                        <p class="text-indigo-400 text-sm">{{ $date }}</p>
                        <h3 class="text-2xl font-semibold">Usuarios Registrados</h3>
                        <p class="text-gray-300 mt-2">Total: {{ $usersCount }} usuarios.</p>
                      </div>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          
          
        
          <div class="min-h-screen bg-gradient-to-br from-gray-900 to-blue-900 flex items-center justify-center relative overflow-hidden">
            <!-- Fondo con ondas -->
            <div class="absolute inset-0">
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 bg-purple-500 opacity-20 rounded-full blur-3xl w-[500px] h-[500px] animate-pulse"></div>
                <div class="absolute bottom-10 right-10 bg-blue-500 opacity-20 rounded-full blur-2xl w-[300px] h-[300px] animate-pulse"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent to-purple-900 opacity-25 [mask-image:radial-gradient(circle,white,transparent)]"></div>
            </div>
        
            
            <div class="relative z-10 text-center max-w-2xl mx-auto p-8">
                <!-- Suscriptores -->
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <div class="flex -space-x-2">
                        @foreach ($doctorsAvatar as $doctor)
                            @if ($doctor->user->avatar)
                                <!-- Si hay avatar, mostrar la imagen -->
                                <img src="{{ asset('storage/' . $doctor->user->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-800">
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c3.866 0 7-3.134 7-7S15.866 0 12 0 5 3.134 5 7s3.134 7 7 7zM12 0c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zM12 14c-2.21 0-4 1.79-4 4v2h8v-2c0-2.21-1.79-4-4-4z"/>
                            </svg>
                            @endif
                        @endforeach
                    </div>
                    <span class="text-gray-400 text-sm">{{ $totalDoctors }} profesionales de la salud ya se han registrado.</span>
                </div>
        
                <!-- Título -->
                <h1 class="text-white text-4xl font-bold mb-2">Suscríbete a nuestras novedades de salud</h1>
                <p class="text-gray-400 text-lg mb-6">
                    Regístrate para recibir contenido exclusivo sobre avances médicos, consejos de salud y noticias del sector. Mantente al día con las últimas tendencias en atención sanitaria.
                </p>
        
                <!-- Formulario -->
                <form class="flex items-center justify-center space-x-3">
                    <input type="email" placeholder="Tu dirección de correo electrónico"
                        class="px-4 py-3 bg-gray-800 text-white rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none w-full max-w-sm">
                    <button type="submit"
                        class="px-6 py-3 bg-purple-600 text-white rounded-lg shadow-lg hover:bg-purple-700 transform hover:scale-105 transition duration-300">
                        Suscribirse →
                    </button>
                </form>
        
                <!-- Nota -->
                <p class="text-gray-500 text-sm mt-4">Sin spam, solo actualizaciones relacionadas con la salud.</p>
            </div>
        </div>

   
      

         <div class=" bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100"">
             
                
             <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-3">
                    <!-- Tarjeta de Soporte -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Soporte</h3>
                        <p class="text-lg text-gray-700 dark:text-gray-300">Si necesitas ayuda, contáctanos a través de nuestro soporte.</p>
                        <a href="mailto:support@socialmedical.com" class="mt-4 inline-block text-blue-500 hover:text-blue-400">Enviar un correo</a>
                    </div>
        
                    <!-- Tarjeta de Noticias -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Noticias Recientes</h3>
                        <ul class="mt-4">
                            <li><a href="#" class="text-blue-500 hover:text-blue-400">Nuevo tratamiento disponible en nuestra plataforma.</a></li>
                            <li><a href="#" class="text-blue-500 hover:text-blue-400">Mejoras en el sistema de citas médicas.</a></li>
                        </ul>
                    </div>
        
                    <!-- Tarjeta de Estadísticas de Usuarios -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Estadísticas de Usuarios</h3>
                        <p class="text-lg text-gray-700 dark:text-gray-300">Visualiza el comportamiento de usuarios registrados y activos.</p>
                        <a href="#" class="mt-4 inline-block text-blue-500 hover:text-blue-400">Ver estadísticas</a>
                    </div>
                 </div>
        
      
         </div>
            
        <footer class="">
            <livewire:layout.footer />
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const themeToggleBtn = document.getElementById('theme-toggle');
                const darkIcon = document.getElementById('theme-toggle-dark-icon');
                const lightIcon = document.getElementById('theme-toggle-light-icon');
        
                // Obtener tema guardado en Local Storage o detectar preferencia del sistema
                const currentTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
                // Actualizar la interfaz y el DOM
                const applyTheme = (theme) => {
                    if (theme === 'dark') {
                        document.documentElement.classList.add('dark');
                        darkIcon.classList.add('hidden');
                        lightIcon.classList.remove('hidden');
                    } else {
                        document.documentElement.classList.remove('dark');
                        darkIcon.classList.remove('hidden');
                        lightIcon.classList.add('hidden');
                    }
                    localStorage.setItem('theme', theme);
                };
        
                applyTheme(currentTheme);
        
                // Alternar el tema
                themeToggleBtn.addEventListener('click', () => {
                    const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
                    applyTheme(newTheme);
                });
            });
        </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggleBtn = document.getElementById('theme-toggle-btn');
        const darkIcon = document.getElementById('theme-toggle-dark-icon-btn');
        const lightIcon = document.getElementById('theme-toggle-light-icon-btn');

        // Obtener tema guardado en Local Storage o detectar preferencia del sistema
        const currentTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        // Actualizar la interfaz y el DOM
        const applyTheme = (theme) => {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }
            localStorage.setItem('theme', theme);
        };

        applyTheme(currentTheme);

        // Alternar el tema
        themeToggleBtn.addEventListener('click', () => {
            const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
            applyTheme(newTheme);
        });
    });
</script>


<script type="text/javascript">
    var users = {{ Js::from($users) }};

    Highcharts.chart('container', {
        chart: {
          //  type: 'pie',
            backgroundColor: '#1a202c', // Fondo oscuro
            style: {
                color: '#ffffff', // Texto blanco
            },
        },
        title: {
            text: 'Crecimiento de Nuevos Usuarios, {{ date("Y") }}',
            style: {
                color: '#ffffff', // Texto blanco
            },
        },
        subtitle: {
            text: 'Fuente: Sistema de Usuarios',
            style: {
                color: '#ffffff', // Texto blanco
            },
        },
        xAxis: {
            categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            
        },
        yAxis: {
            title: {
                text: 'Número de Nuevos Usuarios',
                style: {
                color: '#ffffff', // Texto blanco
            },
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Nuevos Usuarios',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>

<script type="text/javascript">
    // Pasar los datos de especialidades desde el backend a JavaScript
    var specialties = @json($specialties);
    
    // Procesar los datos para Highcharts
    var categories = specialties.map(function(item) { return item.specialty; });
    var counts = specialties.map(function(item) { return item.count; });

    Highcharts.chart('container2', {
        chart: {
            type: 'pie',
            backgroundColor: '#1a202c', // Fondo oscuro
        },
        title: {
            text: 'Cantidad de Doctores por Especialidad',
            style: {
                color: '#ffffff', // Texto blanco
            },
        },
        subtitle: {
            text: 'Source: Social Medical',
            style: {
                color: '#e2e8f0', // Texto más suave
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.percentage:.1f} %',
                    style: {
                        color: '#ffffff',
                    },
                },
                colorByPoint: true,
            },
        },
        series: [{
            name: 'Doctores',
            data: categories.map(function(specialty, index) {
                return {
                    name: specialty,
                    y: counts[index],
                    color: Highcharts.getOptions().colors[index], // Colores automáticos
                };
            }),
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500,
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom',
                    },
                },
            }],
        },
    });
</script>

      
        <script>
            AOS.init({
                once: true
            });
        </script>

        
    <style>
      
  
  /* Efecto de chispas dentro del botón */
  .spark {
  position: absolute;
  width: 4px;
  height: 4px;
  background-color:teal;
  border-radius: 50%;
  animation: spark-animation 0.6s ease-out infinite;
  }
  
  /* Estilo del botón */
  .spark-button {
      position: relative; /* Contenedor relativo para posicionar las chispas dentro */
      overflow: hidden; /* Oculta las chispas que se salen del borde del botón */
  }
  
  .spark {
      position: absolute;
      width: 6px;
      height: 6px;
      background-color:teal;
      border-radius: 50%;
      animation: spark-animation 0.6s ease-out infinite;
  }
  
  .spark-delay-1 {
      animation-delay: 0.1s;
  }
  
  .spark-delay-2 {
      animation-delay: 0.2s;
  }
  
  .spark-delay-3 {
      animation-delay: 0.3s;
  }
  
  .spark-delay-4 {
      animation-delay: 0.4s;
  }
  
  .spark-delay-5 {
      animation-delay: 0.5s;
  }
  
  /* Animación de las chispas */
  @keyframes spark-animation {
      0% {
          transform: translate(0, 0) scale(1);
          opacity: 1;
      }
      50% {
          transform: translate(15px, -15px) scale(1.5);
          opacity: 0.6;
      }
      100% {
          transform: translate(30px, -30px) scale(2);
          opacity: 0;
      }
  }
  
  
  /* Animación para mover el icono sutilmente */
  @keyframes heartbeat-animation {
      0% {
          transform: translateY(0) rotate(0deg);
      }
      50% {
          transform: translateY(-8px) rotate(2deg);
      }
      100% {
          transform: translateY(0) rotate(0deg);
      }
  }
  
  /* Usar la animación con la propiedad animate */
  .animate-heartbeat {
      animation: heartbeat-animation 4s ease-in-out infinite;
  }
  
  
  
  
  
       </style>
    </body>
</html>
