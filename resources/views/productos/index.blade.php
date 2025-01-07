

<x-app-layout>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  
                    <table class="w-full my-0 align-middle text-dark border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->precio }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                         <br>
                         <br>
                        
                    <h1 class=" text-center text-green-900">Crear Producto</h1>
                    <form class=" text-center" method="POST" action="{{ route('productos.store') }}">
                        @csrf
                        <div>
                            <label for="nombre">Nombre:</label><br>
                            <input class=" dark:bg-gray-800 dark:text-white" type="text" name="nombre" id="nombre" required>
                        </div>
                        <div>
                            <label for="descripcion">Descripción:</label><br>
                            <textarea class=" dark:bg-gray-800 dark:text-white" name="descripcion" id="descripcion" required></textarea>
                        </div>
                        <div>
                            <label for="precio">Precio:</label><br>
                            <input class=" dark:bg-gray-800 dark:text-white" type="number" name="precio" id="precio" required>
                        </div>
                        <br>
                        <button type="submit" class=" bg-green-700 text-white py-2 px-4 rounded">Guardar</button>
                    </form>
                              
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>


