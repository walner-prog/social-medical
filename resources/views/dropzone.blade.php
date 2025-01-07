
<x-app-layout>
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Drag and Drop File Upload with Dropzone JS - ItSolutionStuff.com</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      .dz-preview .dz-image img{
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
      }
    </style>
</head>
<body>
    
    <div class="container mx-auto mt-20 py-12 px-4 lg:px-8">
        <div class="card bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
           

            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-800 to-indigo-500 text-white py-4 px-6 flex justify-between items-center">
                <span>Subida de Archivos con Arrastrar y Soltar</span>

            </h3>
            
            <div class="relative inline-block text-left mt-2">
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 bg-blue-600 text-sm font-medium text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="dropdownButton">
                    Opciones
                    <svg class="ml-2 -mr-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7l7 7 7-7"></path>
                    </svg>
                </button>
            
                <!-- Dropdown menu -->
                <div id="dropdownMenu" class="hidden origin-top-right absolute  mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                    <div class="py-1">
                        <a href="{{ route('galery') }}" class="text-gray-600 dark:text-gray-100 block px-4 py-2 text-md-end hover:text-gray-900 dark:hover:text-gray-300 transition duration-300 dark:bg-sky-900 bg-blue-200">
                            Ver Galería de Imágenes
                        </a>
                        <hr>
                        <a href="{{ route('galery') }}" class="text-gray-600 dark:text-gray-100 block px-4 py-2 text-md-end hover:text-gray-900 dark:hover:text-gray-300 transition duration-300 dark:bg-sky-900 bg-blue-200">
                            Ver Galería de Imágenes
                        </a>
                    </div>
                </div>
            </div>
            
            <script>
                const dropdownButton = document.getElementById('dropdownButton');
                const dropdownMenu = document.getElementById('dropdownMenu');
                
                dropdownButton.addEventListener('click', () => {
                    dropdownMenu.classList.toggle('hidden');
                });
            </script>
            
            <!-- Body -->
            <div class="card-body p-6">
                <!-- Descripción -->
                <p class="text-gray-700 dark:text-gray-300 text-center mb-6">
                    Organiza tus imágenes de manera sencilla. Utiliza esta herramienta para cargar múltiples archivos 
                    arrastrándolos al área indicada o haciendo clic en ella. Disfruta de una experiencia rápida, intuitiva 
                    y totalmente optimizada.
                </p>
    
                <!-- Formulario Dropzone -->
                <form 
                    action="{{ route('dropzone.store') }}" 
                    method="post" 
                    enctype="multipart/form-data" 
                    id="image-upload" 
                    class="dropzone border-dashed border-4 border-blue-900 dark:border-blue-800 p-8 rounded-lg transition-all hover:shadow-xl">
                    @csrf
                    <div>
                        <h4 class="text-lg font-medium text-center text-gray-700 dark:text-gray-300">
                            Arrastra tus imágenes aquí o haz clic para seleccionarlas
                        </h4>
                    </div>
                </form>
    
                <!-- Botón de subida -->
                <button 
                    id="uploadFile" 
                    class="w-full bg-blue-800 text-white py-3 rounded-lg mt-5 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    Subir Imágenes
                </button>
            </div>
        </div>
    </div>
    
    
    
    
    
    
<script type="text/javascript">
  
        Dropzone.autoDiscover = false;

        var images = {{ Js::from($images) }};
  
        var myDropzone = new Dropzone(".dropzone", { 
            init: function() { 
                myDropzone = this;

                $.each(images, function(key,value) {
                    var mockFile = { name: value.name, size: value.filesize};
     
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.path);
                    myDropzone.emit("complete", mockFile);
          
                });
            },
           autoProcessQueue: false,
           paramName: "files",
           uploadMultiple: true,
           maxFilesize: 5,
           acceptedFiles: ".jpeg,.jpg,.png,.gif"
        });
      
        $('#uploadFile').click(function(){
           myDropzone.processQueue();
        });

        
  
</script>
    
</body>
</html>


</x-app-layout>
