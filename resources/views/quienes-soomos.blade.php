<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        @livewireStyles
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        
        <div class="py-24 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3 mb-10">
                    <!-- Sección: Quienes Somos -->
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-users text-2xl mr-2 text-indigo-500"></i> ¿Quiénes Somos?
                                </h3>
                            </div>
                            <div class="flex flex-wrap items-center py-8 pt-6 px-9">
                                <!-- Texto -->
                                <div class="w-full sm:w-1/2 pr-4 mb-4 sm:mb-0">
                                    <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                        En <strong>Social Medical</strong>, somos una plataforma innovadora creada para conectar a pacientes con médicos de confianza, facilitando la atención médica de calidad a través de la tecnología. Nuestra misión es ofrecer un canal fácil y accesible para que los pacientes encuentren los mejores profesionales de la salud en todo el país.
                                        <br><br>
                                        Los usuarios pueden buscar médicos según su especialidad, ciudad o incluso otros filtros, lo que permite una búsqueda personalizada y rápida para satisfacer las necesidades de cada paciente. Ya sea que busques un cardiólogo en tu ciudad o un pediatra especializado, en <strong>Social Medical</strong> encontrarás a los mejores profesionales de la salud listos para atenderte.
                                    </p>
                                </div>
                                <!-- Imagen -->
                                <div class="w-full sm:w-1/2 pl-4">
                                    <img src="{{ asset('images/doctor.png') }}" alt="Doctor" class="w-full h-auto rounded-lg shadow-lg" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
        
                    <!-- Sección: Visión -->
                    <div class="relative flex-[1_auto] flex flex-col sm:flex-row items-center justify-between break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-delay="200">
                        <!-- Texto de la sección -->
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30 sm:w-1/2">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-bullseye text-2xl mr-2 text-green-500"></i> Visión
                                </h3>
                            </div>
                            <div class="flex-auto block py-8 pt-6 px-9">
                                <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                    En <strong>Social Medical</strong>, nuestra visión es ser la plataforma líder en atención médica digital, creando un puente entre los mejores médicos y pacientes a través de tecnología avanzada. Queremos transformar el acceso a la salud, haciendo que encontrar atención médica de calidad sea más fácil, rápido y accesible para todos.
                                    <br><br>
                                    Nuestro objetivo es proporcionar una red global de médicos confiables que brinden una atención personalizada. Gracias a nuestra plataforma, los pacientes pueden encontrar médicos especializados de acuerdo a su ubicación, necesidades y preferencias, mejorando así su experiencia de salud y calidad de vida.
                                </p>
                            </div>
                        </div>
                    
                        <!-- Imagen del doctor -->
                        <div class="sm:w-1/2 mt-6 sm:mt-0">
                            <img src="{{ asset('images/doctor2.png') }}" alt="Imagen de médico" class="w-full h-auto rounded-lg shadow-lg">
                        </div>
                    </div>
                    
                    
        
                    <!-- Sección: Misión -->
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-hand-holding-heart text-2xl mr-2 text-blue-500"></i> Misión
                                </h3>
                            </div>
                            <div class="flex-auto block py-8 pt-6 px-9">
                                <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                    Nuestra misión es proporcionar un acceso rápido, fácil y confiable a servicios médicos de calidad. A través de nuestra plataforma, los pacientes pueden encontrar médicos especializados, agendar citas de manera eficiente, y recibir atención desde la comodidad de su hogar. Buscamos mejorar la experiencia médica utilizando tecnología avanzada y atención personalizada.
                                </p>
                            </div>
                        </div>
                    </div>
        
                    <!-- Sección: Qué Queremos Lograr -->
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-delay="600">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-trophy text-2xl mr-2 text-yellow-500"></i> ¿Qué Queremos Lograr?
                                </h3>
                            </div>
                            <div class="flex-auto block py-8 pt-6 px-9">
                                <p class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                    Queremos lograr una red médica digital que transforme la atención sanitaria, permitiendo que cualquier persona, en cualquier lugar, tenga acceso a médicos de confianza y especializados. Nuestra meta es ser la plataforma de salud más accesible y eficiente a nivel global.
                                </p>
                            </div>
                        </div>
                    </div>
        
                    <!-- Sección: Metas -->
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-lg bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800 text-gray-800 dark:text-gray-100" data-aos="fade-up" data-aos-delay="800">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl font-semibold text-dark">
                                    <i class="fas fa-bullhorn text-2xl mr-2 text-red-500"></i> Metas
                                </h3>
                            </div>
                            <div class="flex-auto block py-8 pt-6 px-9">
                                <ul class="list-disc pl-6 text-lg text-gray-700 dark:text-gray-300">
                                    <li>Expandir nuestra red de médicos en un 50% durante el primer año.</li>
                                    <li>Proporcionar acceso a más de 1 millón de pacientes en los próximos dos años.</li>
                                    <li>Desarrollar herramientas de telemedicina avanzadas para una experiencia médica más personalizada.</li>
                                    <li>Alcanzar una satisfacción del cliente del 95% para finales de 2025.</li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    @if (!$isRegistered)
                    <div id="notification" class="fixed bottom-4 right-4 bg-blue-600 text-white p-4 rounded-lg shadow-lg flex items-center space-x-4 z-50" style="display: flex;" data-aos="fade-up" data-aos-duration="800">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-plus text-xl"></i>
                            <span class="text-sm">¡Aún no te has registrado! Regístrate para acceder a todas las funciones.</span>
                        </div>
                        <div class="ml-4">
                            <button onclick="closeNotification()" class="text-white text-lg">&times;</button>
                        </div>
                        <div class="ml-4">
                            <a href="/register" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-full text-sm">Regístrate</a>
                        </div>
                        <div class="ml-4">
                            <a href="/login" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-full text-sm">Iniciar sesión</a>
                        </div>
                    </div>
                @endif

                </div>
            </div>
        </div>
        


    </div>


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
<script>
    // Inicializar AOS después de cargar la página
    AOS.init({
        duration: 500, // Duración de la animación en milisegundos
        once: true, // Ejecutar la animación solo una vez
    });

    // Función para cerrar la notificación
    function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
</script>




    </body>
    </html>
  
   



</x-app-layout>