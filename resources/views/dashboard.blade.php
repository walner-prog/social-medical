<x-app-layout>

    

    @php
    $userRole = auth()->user()->role; // Obtienes el rol del usuario logueado
    @endphp
<style>
    
</style>
<div class="mt-12">
    
     
       
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
        <section 
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
                 
                <div class=" mb-4 py-8">
                    <livewire:promotion-timer />
                 </div>
             
                
            </div>
            
            
        </section>
    
        <!-- Cards y Texto Adicional -->
        <section  class="flex flex-col lg:flex-row items-center lg:justify-between px-4 md:px-8 py-8 md:py-16 space-y-8 lg:space-y-0">
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
    
    

    <div  class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
        <!-- Contenido basado en el rol -->
        @if ($userRole == 'doctor')
            <!-- Panel para Doctores -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8 mt-12">
                <!-- Columna para la imagen -->
                <div class="w-full lg:w-1/2">
                    <img src="images/medico.png" alt="Médico" class="rounded-lg shadow-lg">
                </div>
                
                <!-- Columna para las cards -->
                <div class="w-full lg:w-1/2 space-y-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-user-injured text-blue-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Tus Pacientes</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300">Ver pacientes registrados en tu especialidad.</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-calendar-check text-green-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Citas Pendientes</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300">Consulta las citas que tienes programadas.</p>
                                <a href="{{ route('citas.programadas') }}" class="text-blue-500 hover:text-blue-700">Ver Citas Pendientes</a>
                            </div>
                        </div>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-user-edit text-yellow-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Actualizar Perfil</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300">Actualizar tu información personal y disponibilidad.</p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-newspaper text-blue-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Gestión de Publicaciones</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300 mt-4">
                                    Accede y administra tus publicaciones.
                                </p>
                             
                                @if (auth()->user() && auth()->user()->hasRole('doctor'))
                                <a href="{{ route('blogs.accions') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-400">
                                    Gestionar Mis Publicaciones
                                </a>
                            @endif
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
            
        @elseif ($userRole == 'patient')
            <!-- Panel para Pacientes -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8 mt-12">
                <!-- Columna para la imagen -->
                <div class="w-full lg:w-1/2">
                    <img src="images/medico.png" alt="Médico" class="rounded-lg shadow-lg">
                </div>
                
                <!-- Columna para las cards -->
                <div class="w-full lg:w-1/2 space-y-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-stethoscope text-purple-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Tus Citas</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300">Consulta tus citas médicas y historial de consultas.</p>
                                <a href="{{ route('citas.program') }}" class="text-blue-500 hover:text-blue-700">Ver Citas Pendientes</a>
                            </div>
                        </div>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-users text-teal-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Ver Médicos</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300">Encuentra médicos disponibles según su especialidad, ciudad o experiencia.</p>
                                <x-nav-link :href="route('doctores.index')" :active="request()->routeIs('doctores.index')" wire:navigate>
                                    {{ __('Doctores') }}
                                </x-nav-link>
                            </div>
                        </div>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-headset text-red-500 text-3xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Contactar Soporte</h3>
                                <p class="text-lg text-gray-700 dark:text-gray-300">Si necesitas ayuda, contáctanos a través de soporte.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @elseif ($userRole == 'admin')
            <!-- Panel para Administradores -->
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-users-cog text-orange-500 text-3xl"></i>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Usuarios Registrados</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300">Gestionar los usuarios registrados en el sistema.</p>
                        </div>
                    </div>
                </div>
    
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-chart-bar text-indigo-500 text-3xl"></i>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Estadísticas Generales</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300">Ver estadísticas globales de la plataforma.</p>
                        </div>
                    </div>
                </div>
    
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-user-md text-green-500 text-3xl"></i>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Gestión de Doctores</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300">Aprobar y gestionar los doctores registrados.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <br>
    


            </div>
        

        

        
       
            
            
            <div class="bg-gradient-to-b from-[#0F1020] to-[#1B1D35] min-h-screen flex items-center justify-center py-10 px-4">
                <div class="max-w-5xl w-full bg-opacity-80 p-6 rounded-xl shadow-lg">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6">
                      <h1 class="text-white text-4xl font-bold leading-tight">The most powerful APIs built specifically for the Modern Web</h1>
                      <p class="text-gray-300 text-lg">We agonize over every detail so your teams don’t need to spend months building, and then maintaining rote authentication functionality.</p>
                      <a href="#" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105">Explore the Docs</a>
                    </div>
              
                    <!-- Right Content -->
                    <div class="relative">
                      <div class="bg-[#1D2237] p-4 rounded-xl shadow-lg">
                        <div class="flex justify-between mb-4 text-gray-400">
                          <button class="px-3 py-1 rounded bg-gray-700 text-gray-300">SignUp.js</button>
                          <button class="px-3 py-1 rounded bg-gray-700 text-gray-300">SignIn.js</button>
                       
                          <button class="px-3 py-1 rounded bg-gray-700 text-gray-300">UserProfile.js</button>
                        </div>
                        <pre class="bg-[#1A1D2E] p-4 rounded-lg text-white text-sm font-mono overflow-auto">
                import { UserButton } from '@clerk/nextjs';
              
                    export default function Page() {
                return <UserButton />;
                }
                        </pre>
                      </div>
              
                      <!-- Framework Icons -->
                      <div class="mt-6 grid grid-cols-3 gap-4">
                        <img src="/path/to/nodejs-icon.svg" alt="NodeJS" class="h-10 mx-auto">
                        <img src="/path/to/go-icon.svg" alt="Go" class="h-10 mx-auto">
                        <img src="/path/to/hasura-icon.svg" alt="Hasura" class="h-10 mx-auto">
                      </div>
                    </div>
                  </div>
              
                  <!-- Bottom Section -->
                  <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-10 text-center">
                    <div class="space-y-4">
                      <div class="bg-gray-700 p-4 rounded-lg inline-block">
                        <span class="text-white text-2xl">Tools for every stack</span>
                      </div>
                      <p class="text-gray-300">We have powerful SDKs and APIs built for many modern frameworks like Next.js.</p>
                    </div>
              
                    <div class="space-y-4">
                      <div class="bg-gray-700 p-4 rounded-lg inline-block">
                        <span class="text-white text-2xl">Pre-built Integrations</span>
                      </div>
                      <p class="text-gray-300">Send your user data to tools like Stripe, Segment, and many others — right from the source.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class=" from-[#E6E9F0] to-[#EEF1F6] min-h-screen flex flex-col py-10 px-4 dark:bg-gray-900  dark:text-gray-100">
                <!-- Sección del Encabezado -->
                <div class="text-center mb-16">
                    <h1 class="text-4xl md:text-6xl font-bold ">
                        Actividades Recientes <br />
                        <span class="italic">Mantente al día con <span class="underline">lo que sucede</span></span>
                    </h1>
                </div>
            
                <!-- Sección de Actividades -->
                <div class="bg-gradient-to-b from-[#0F1020] to-[#1B1D35] dark:bg-gray-900 py-10 px-6 rounded-tl-3xl rounded-tr-3xl shadow-2xl">
                    <div class="flex justify-between items-center text-white mb-8">
                        <h2 class="text-2xl font-semibold">Principales <span class="text-purple-500">Actividades Recientes</span></h2>
                       {{--                         <a href="#" class="text-white hover:underline flex items-center gap-2">Ver Todas <span class="font-bold">→</span></a> --}}
                    </div>
            
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Tarjeta de Actividad -->
                        @foreach($recentActivities as $activity)
                        <div class="bg-gray-800 p-4 rounded-lg text-white shadow-lg hover:shadow-2xl transition-transform transform hover:scale-105 relative group">
                            <!-- Efecto de Iluminación -->
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-500 opacity-0 group-hover:opacity-20 rounded-lg transition"></div>
                            
                            <div class="flex items-center mb-4">
                                <!-- Ícono o Imagen -->
                                <div class="w-12 h-12 rounded-full bg-gray-500 overflow-hidden flex items-center justify-center shadow-lg">
                                    <i class="fas fa-save"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold">{{ $activity->activity }}</h3>
                                    <p class="text-sm text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
            
                            <p class="text-gray-300 mb-4">
                                {{ $activity->description }}
                            </p>
            
                            @if($activity->type === 'post')
                            <a href="{{ route('posts.show', $activity->post->id) }}" 
                               class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-500 transition">
                                Ver Publicación →
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            
              
              <div class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 min-h-screen py-10 text-white">
                <div class="text-center">
                  <h1 class="text-4xl font-bold mb-4">What's New</h1>
                  <p class="text-gray-400">New updates and improvements to Stellar.</p>
                </div>
              
                <div class="relative max-w-4xl mx-auto mt-12">
                  <!-- Timeline Line -->
                  <div class="absolute top-0 left-1/2 -translate-x-1/2 h-full w-1 bg-gradient-to-b from-indigo-500 to-purple-500"></div>
              
                  <!-- Timeline Item 1 -->
                  <div class="relative mb-12">
                    <div class="flex items-center justify-start">
                      <div class="w-1/2 pr-8 text-right">
                        <p class="text-indigo-400 text-sm">Nov 22, 2024</p>
                        <h3 class="text-2xl font-semibold">Weekly Update: Stellar X</h3>
                        <p class="text-gray-300 mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu enim velit.</p>
                      </div>
                      <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full shadow-lg">
                        <span class="text-lg font-bold">v7</span>
                      </div>
                    </div>
                  </div>
              
                  <!-- Timeline Item 2 -->
                  <div class="relative mb-12">
                    <div class="flex items-center justify-end">
                      <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full shadow-lg">
                        <span class="text-lg font-bold">v6</span>
                      </div>
                      <div class="w-1/2 pl-8 text-left">
                        <p class="text-indigo-400 text-sm">Nov 22, 2024</p>
                        <h3 class="text-2xl font-semibold">Refreshed main menu navigation</h3>
                        <ul class="list-disc list-inside mt-2 text-gray-300">
                          <li>Streamlined visuals with updated templates.</li>
                          <li>Seamless updates to Stellar in a single view.</li>
                        </ul>
                      </div>
                    </div>
                  </div>
              
                  <!-- Timeline Item 3 -->
                  <div class="relative mb-12">
                    <div class="flex items-center justify-start">
                      <div class="w-1/2 pr-8 text-right">
                        <p class="text-indigo-400 text-sm">Nov 4, 2024</p>
                        <h3 class="text-2xl font-semibold">New cloud architecture</h3>
                        <p class="text-gray-300 mt-2">Newly created diagrams and enhanced scalability.</p>
                      </div>
                      <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full shadow-lg">
                        <span class="text-lg font-bold">v5</span>
                      </div>
                    </div>
                  </div>
              
                  <!-- Timeline Item 4 -->
                  <div class="relative">
                    <div class="flex items-center justify-end">
                      <div class="relative flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full shadow-lg">
                        <span class="text-lg font-bold">v4</span>
                      </div>
                      <div class="w-1/2 pl-8 text-left">
                        <p class="text-indigo-400 text-sm">Oct 12, 2024</p>
                        <h3 class="text-2xl font-semibold">Updates to the Filtering API</h3>
                        <p class="text-gray-300 mt-2">Easier management with better performance metrics.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            
              <div class="min-h-screen bg-gradient-to-br from-gray-900 to-blue-900 flex items-center justify-center relative overflow-hidden">
                <!-- Fondo con ondas -->
                <div class="absolute inset-0">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 bg-purple-500 opacity-20 rounded-full blur-3xl w-[500px] h-[500px] animate-pulse"></div>
                    <div class="absolute bottom-10 right-10 bg-blue-500 opacity-20 rounded-full blur-2xl w-[300px] h-[300px] animate-pulse"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-purple-900 opacity-25 [mask-image:radial-gradient(circle,white,transparent)]"></div>
                </div>
            
                <!-- Contenido principal -->
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
      
        </div>
    </div>
    
   

  

   
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



.fade-down {
    opacity: 0;
    transform: translateY(-30px);
    transition: opacity 0.8s ease, transform 0.8s ease;
  }
  
  .fade-down.show {
    opacity: 1;
    transform: translateY(0);
  }
  


     </style>
     <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Selecciona todos los elementos con la clase 'fade-down'
    const fadeDownElements = document.querySelectorAll('.fade-down');

    fadeDownElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('show'); // Agrega la clase para iniciar el efecto
        }, index * 200); // Retraso opcional para elementos múltiples
    });
});

     </script>

  
</x-app-layout>

