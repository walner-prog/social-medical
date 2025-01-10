<x-app-layout>
    <div class="py-24  mx-auto sm:px-6 lg:px-8 dark:bg-gray-900 dark:text-gray-100 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Categoría y Posts -->
            <livewire:category-posts :slug="$category->slug" />

            <!-- Últimas Publicaciones -->
            <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Últimas Publicaciones</h2>

                <livewire:latest-posts />

            </div>
        </div>
    </div>
</x-app-layout>
