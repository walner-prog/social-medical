<div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h1>
    <span class="text-sm text-gray-500 dark:text-gray-400">
      Total de posts: <span class="font-semibold">{{ $category->posts_count }}</span>
    </span>
  
    <div class="mt-6 grid sm:grid-cols-2 gap-4"> @foreach($posts as $post)
        <div class="p-6 bg-gray-100 dark:bg-slate-700 rounded-lg shadow-sm hover:shadow-xl transition duration-300 ease-in-out">
          <h2 class="font-semibold text-lg text-gray-900 dark:text-white">{{ $post->title }}</h2>
          @if ($post->image)
          <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="rounded-t-lg object-cover h-48">
          @else
          <div class="w-48 h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-md shadow">
              <i class="fas fa-image text-gray-500 text-xl "></i>
          </div>
          @endif
          <p class="text-sm text-gray-500 dark:text-gray-400">
            <span class="font-semibold text-blue-500">Fecha:</span> {{ $post->created_at->format('d M Y') }}
          </p>
          <p class="text-sm text-gray-500 dark:text-gray-400">
            <span class="font-semibold text-blue-500">Creado por:</span> {{ $post->user->name }}
          </p>
          <a href="{{ route('posts.show', $post->slug) }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out">
            <i class="fas fa-info-circle mr-2"></i> Leer más
          </a>
        </div>
      @endforeach
    </div>
  
    <div class="mt-4">
      {{ $posts->links() }} </div>
  </div>