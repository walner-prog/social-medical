

<x-app-layout>
    <div class="py-24">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">
            @livewire('post-edit', ['post' => $post])
        </div>
    </div>
    
</x-app-layout>
