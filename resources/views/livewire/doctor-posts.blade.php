<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-md flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6 flex justify-end">
        <a href="{{ route('blog.create') }}" class=" bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500">
            Crear Publicación
        </a>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-6 flex space-x-4">
        <!-- Búsqueda por título -->
        <div class="w-full">
            <label for="search" class="block text-gray-800 dark:text-gray-200 font-semibold mb-2">
                <i class="fas fa-search mr-2"></i> Buscar por título
            </label>
            <input type="text" id="search" wire:model="search" placeholder="Buscar publicaciones..." class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500">
        </div>

        <!-- Búsqueda por categoría -->
        <div class="w-full">
            <label for="categorySearch" class="block text-gray-800 dark:text-gray-200 font-semibold mb-2">
                <i class="fas fa-filter mr-2"></i> Buscar por categoría
            </label>
            <select id="categorySearch" wire:model="categorySearch" class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500">
                <option value="">Seleccionar categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón de búsqueda -->
        <div class="flex items-end">
            <button wire:click="searchPosts" class="bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">
                <i class="fas fa-search mr-2"></i> Buscar
            </button>
        </div>
    </div>

    <!-- Mensaje cuando no se encuentran resultados -->
    @if ($noResultsMessage)
        <div class="mb-4 p-4 bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 rounded-md flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ $noResultsMessage }}
        </div>
    @endif

    <!-- Tabla de publicaciones -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Título</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Categoría</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="py-3 px-4 text-sm text-gray-800 dark:text-gray-200 border-b">{{ $post->title }}</td>
                        <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400 border-b">{{ $post->category->name }}</td>
                        <td class="py-3 px-4 text-sm border-b">
                            <a href="{{ route('blog.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit mr-2"></i> Editar
                            </a>
                            <button wire:click="deletePost({{ $post->id }})" class="text-red-500 hover:text-red-700 ml-4">
                                <i class="fas fa-trash-alt mr-2"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>

       @if ($showDeleteModal)
            
       <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Confirmar Eliminación</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">Por favor, copie el título del post para confirmar la eliminación:</p>
            <input type="text" wire:model="postTitleToConfirm" class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">El título debe coincidir exactamente.</p>

            <div class="mt-4 flex justify-between">
                <button wire:click="closeModal" class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200 p-2 rounded-lg">Cancelar</button>
                <button wire:click="deletePost" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600">Eliminar</button>
            </div>
        </div>
    </div>
       @endif

</div>
