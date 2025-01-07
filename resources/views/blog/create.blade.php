

<x-app-layout>
   

    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  
                    <h1>{{ isset($postId) ? 'Edit Post' : 'Crear Nuevo Post' }}</h1>
                     @livewire('post-management', ['postId' => $postId ?? null])
                              
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>


