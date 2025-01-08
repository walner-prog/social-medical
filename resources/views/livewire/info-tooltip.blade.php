<div x-data="{ open: false }" class="relative">
    <!-- Contador con ícono -->
    <div class="flex items-center cursor-pointer" 
         @click="open = !open" 
         wire:poll.2s="loadData">
        <i class="fas fa-info-circle text-blue-600 hover:text-blue-700 text-xl transition-all duration-300"></i>
        <span class="ml-2 text-blue-600 font-semibold">{{ $count }}</span>
    </div>

    <!-- Tooltip con información dinámica -->
    <div x-show="open" x-transition @click.away="open = false" 
         class="absolute left-0 mt-2 w-80 bg-white p-4 rounded-lg shadow-lg border border-indigo-200">
        <h4 class="text-lg font-semibold text-indigo-600">{{ $info['title'] ?? 'Sin información' }}</h4>
        <p class="text-gray-700">
            <strong>Detalles:</strong> {{ $info['details'] ?? 'N/A' }} <br>
            <strong>Fecha:</strong> {{ $info['date'] ?? 'N/A' }}
        </p>
    </div>
</div>
