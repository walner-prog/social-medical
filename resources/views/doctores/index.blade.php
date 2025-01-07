<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
     
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        @livewireStyles
    </head>
    <body>
        
    <div class=" py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
            <div class="flex flex-wrap -mx-3 mb-5">
               
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8  dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30 ">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                    <span class="mr-3 font-semibold text-dark"> Lista de Doctores</span>
                                </h3>
                            </div>
        
                            <div class="flex-auto block py-8 pt-6 px-9">
                                <livewire:doctor-profile />
                            </div>

                          
                            
                            
                        </div>
                    
                        
                    </div>

                   
                    <div>
                      
                        
                      


                    </div>
               
            </div>
        </div>


        <div class="container mx-auto p-6">
            <!-- Título y datos del doctor -->
            @if ($doctor && $doctor->user)
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Bienvenido, Dr. {{ $doctor->user->name }}</h1>
                <p class="text-gray-600 mt-2"><strong>Especialidad:</strong> {{ $doctor->specialty }}</p>
                <p class="text-gray-600 mt-1"><strong>Años de experiencia:</strong> {{ $doctor->experience_years }}</p>
                <p class="text-gray-600 mt-1"><strong>Ciudad:</strong> {{ $doctor->city }}</p>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Información del doctor no disponible.</h1>
            </div>
        @endif
    
            <!-- Título de Citas Programadas -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Citas Programadas</h2>
    
            <!-- Si no hay citas programadas -->
            @if ($appointments->isEmpty())
            <p class="text-gray-600">No tienes citas programadas.</p>
            @else
            <!-- Tabla de citas -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            @if(auth()->user()->hasRole('doctor'))
                                <th class="px-4 py-2 text-left">Paciente</th>
                            @else
                                <th class="px-4 py-2 text-left">Doctor</th>
                            @endif
                            <th class="px-4 py-2 text-left">Fecha de la Cita</th>
                            <th class="px-4 py-2 text-left">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-b">
                                @if(auth()->user()->hasRole('doctor'))
                                    <td class="px-4 py-2">{{ $appointment->patient_name }}</td>
                                @else
                                    <td class="px-4 py-2">{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                                @endif
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                        Ver detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
        </div>

      
       
    </div>


  
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
<script>
    // Inicializar AOS después de cargar la página
    AOS.init({
        duration: 500, // Duración de la animación en milisegundos
        once: true, // Ejecutar la animación solo una vez
    });
</script>




    </body>
    </html>
  
   



</x-app-layout>





{{-- 

  <div class="min-h-screen bg-gradient-to-b from-gray-900 via-purple-900 to-black flex items-center justify-center">
                                <div class="relative text-center p-10">
                                    <!-- Iluminación detrás del contenido -->
                                    <div class="absolute inset-0 bg-purple-700 opacity-50 rounded-full blur-3xl animate-pulse"></div>
                            
                                    <!-- Contenido principal -->
                                    <div class="relative z-10">
                                        <h5 class="text-purple-300 text-lg font-semibold mb-2">The security first platform</h5>
                                        <h1 class="text-white text-5xl font-bold mb-4">Build your own integration</h1>
                                        <p class="text-gray-400 text-lg max-w-xl mx-auto">
                                            All the lorem ipsum generators on the Internet tend to repeat predefined chunks as necessary,
                                            making this the first true generator on the Internet.
                                        </p>
                                        <button class="mt-6 px-6 py-3 bg-white text-gray-900 font-medium rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300">
                                            Start Building →
                                        </button>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="min-h-screen bg-gradient-to-b from-gray-900 to-black flex items-center justify-center relative overflow-hidden">
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
                                            <img src="https://via.placeholder.com/40" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-800">
                                            <img src="https://via.placeholder.com/40" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-800">
                                            <img src="https://via.placeholder.com/40" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-800">
                                        </div>
                                        <span class="text-gray-400 text-sm">20K have already subscribed.</span>
                                    </div>
                            
                                    <!-- Título -->
                                    <h1 class="text-white text-4xl font-bold mb-2">Join our newsletter</h1>
                                    <p class="text-gray-400 text-lg mb-6">
                                        Sign up to get early access to product launches, promotions, and exclusive offers. 
                                        Join our newsletter today!
                                    </p>
                            
                                    <!-- Formulario -->
                                    <form class="flex items-center justify-center space-x-3">
                                        <input type="email" placeholder="Your email address"
                                            class="px-4 py-3 bg-gray-800 text-white rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none w-full max-w-sm">
                                        <button type="submit"
                                            class="px-6 py-3 bg-purple-600 text-white rounded-lg shadow-lg hover:bg-purple-700 transform hover:scale-105 transition duration-300">
                                            Subscribe →
                                        </button>
                                    </form>
                            
                                    <!-- Nota -->
                                    <p class="text-gray-500 text-sm mt-4">No spam, only helpful content.</p>
                                </div>
                            </div>
                            
                            --}}