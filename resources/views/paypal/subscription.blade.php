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
                                <div class="container mt-5">
                                    @if(session('success'))
                                             
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                   @endif

                                   @if(session('error'))
                                           
                                   <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                    <h1>Planes de Suscripción</h1>
                                    <div class="row">
                                        <!-- Plan Mensual -->
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h3>Mensual</h3>
                                                    <p>$5 USD</p>
                                                    <a href="{{ route('paypal.create', ['amount' => 5]) }}" class="btn btn-primary">Suscribirse</a>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <!-- Plan Semestral -->
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h3>Semestral</h3>
                                                    <p>$50 USD</p>
                                                    <a href="{{ route('paypal.create', ['amount' => 50]) }}" class="btn btn-primary">Suscribirse</a>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <!-- Plan Anual -->
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h3>Anual</h3>
                                                    <p>$80 USD</p>
                                                    <a href="{{ route('paypal.create', ['amount' => 80]) }}" class="btn btn-primary">Suscribirse</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
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
</script>




    </body>
    </html>
  
   



</x-app-layout>