<div x-data="{ open: false }" class="relative">
    <!-- Contador de publicaciones con ícono -->
    <div class="flex items-center cursor-pointer" 
    @click="open = !open" 
    wire:poll.2s>
    <i class="fas fa-blog text-indigo-600 hover:text-indigo-700 text-xl transition-all duration-300"></i>
    <span class="ml-2 text-indigo-600 font-semibold">{{ $postCount }}</span>
    </div>

    <!-- Tooltip con la última publicación -->
    <div x-show="open" x-transition @click.away="open = false" 
        class="absolute left-0 mt-2 w-80 bg-white p-4 rounded-lg shadow-lg border border-indigo-200">
        <h4 class="text-lg font-semibold text-indigo-600">Última Publicación:</h4>
        <p class="text-gray-700">
            <strong>Título:</strong> {{ $latestPost->title ?? 'No hay publicaciones' }} <br>
            <strong>Fecha:</strong> {{ $latestPost->created_at->format('d M Y') ?? 'N/A' }}
        </p>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('post-created', () => {
            console.log('Se creó un nuevo post.');
        });
    });
</script>
