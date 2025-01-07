
<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        
    </head>
    <body>
        
        <div class="container mx-auto mt-22 py-12 px-6 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 shadow-lg rounded-lg">
            <!-- Encabezado principal -->
           
        
            <!-- Galería interactiva -->
            <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
              
                <!-- Descripción del valor agregado -->
               
                <livewire:image-gallery />
            </div>
        
            <!-- Sugerencia de acción -->
            <div class="text-center mt-8">
                <p class="text-gray-700 dark:text-gray-500">
                    ¿Nuevo aquí? ¡Empieza subiendo tus primeras imágenes y organiza tus recuerdos!
                </p>
                <a href="{{ route('dropzone') }}">
                    <button class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                        Subir Imagen
                    </button>
                </a>
            </div>
        </div>
        
        
        
        
        
        
        
    </body>
    </html>
    
    
    </x-app-layout>
    