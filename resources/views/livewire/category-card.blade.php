<div class="space-y-4">
    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out dark:bg-gray-800 dark:border-gray-700">
        <!-- Título de la tarjeta -->
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white text-center mb-6">
            Categorías de Posts
        </h2>
        
        <!-- Contenido de las categorías -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="p-4 bg-gray-100 rounded-lg shadow hover:shadow-xl transition-shadow duration-300 ease-in-out dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex items-center space-x-4">
                        <!-- Icono de categoría -->
                        <div class="text-blue-500 text-3xl">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <!-- Nombre de la categoría -->
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                <span class="inline-block mr-2 text-blue-500"><i class="fas fa-file-alt"></i></span>
                                Total de posts: {{ $category->posts_count }}
                            </p>
                        </div>
                    </div>
                    <!-- Enlace para ver los posts -->
                    <a href="{{ route('category.posts', $category->slug) }}" class="mt-4 inline-block text-blue-500 hover:underline">
                        <i class="fas fa-arrow-right"></i> Ver posts
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $categories->links() }} <!-- Livewire paginación -->
        </div>
    </div>
</div>
