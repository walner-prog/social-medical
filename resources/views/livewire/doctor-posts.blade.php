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
                            <button wire:click="confirmDelete({{ $post->id }})" class="text-red-500 hover:text-red-700 ml-4">
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

    @if($showDeleteModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h2 class="text-lg font-semibold text-gray-800">¿Estás seguro de que deseas eliminar esta publicación?</h2>
            <div class="mt-4 flex justify-end">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Cancelar</button>
                <button wire:click="deletePost" class="px-4 py-2 ml-2 bg-red-500 text-white rounded-md hover:bg-red-600">Eliminar</button>
            </div>
        </div>
    </div>
@endif

</div>
