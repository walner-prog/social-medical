<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($latestPosts as $post)
    <div class=" rounded-lg bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 transition duration-300">
        
        @if ($post->image)
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="rounded-t-lg object-cover h-48">
        @else
        <div class="w-48 h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-md shadow">
            <i class="fas fa-image text-gray-500 text-xl "></i>
        </div>
        @endif
        <div class="p-6">
            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-400 hover:underline">
                <p class="text-xl font-bold mb-2">{{ $post->title }}</p>
              </a>
            <p class="text-gray-700 text-base mb-4">
                {{ Str::limit($post->excerpt, 100) }}
            </p>
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    <span class="font-bold dark:text-cyan-800">Categoría:</span> {{ $post->category->name }}
                 
                    <span class="font-bold dark:text-cyan-800">Fecha:</span> {{ $post->created_at->format('d M Y') }}
                </div>
              
            </div>
        </div>
    </div>
    @endforeach
</div>