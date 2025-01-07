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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-3 mb-5 space-y-6">
                <div class="relative flex-[1_auto] flex flex-col break-words  min-w-0 rounded-[.95rem] bg-gradient-to-r dark:from-blue-900 to-blue-700 p-6 shadow-lg">
                    <div class="relative flex flex-col min-w-0 border-gray-200 bg-opacity-50 rounded-lg">
                        <div class="px-4 py-2 mt-4">
                            <a href="{{ route('appointmentCalendar') }}" 
                               class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 w-full sm:w-auto max-lg:mx-3">
                                Agendar Cita
                            </a>
                        </div>
                        <livewire:cita-prograpacient />
                    </div>
                </div>
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

