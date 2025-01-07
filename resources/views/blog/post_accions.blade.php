

<x-app-layout>
    <div class="py-24">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">
            @livewire('doctor-posts')


        </div>
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Columna 1: Mostrar las sugerencias -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <livewire:show-suggestions />
                </div>
        
                <!-- Columna 2: Otro contenido que desees -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Otro Contenido</h2>
                    <p>Este es otro contenido que va al lado del componente de sugerencias. Puedes incluir cualquier tipo de contenido aquí, como formularios, texto, imágenes, etc.</p>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
