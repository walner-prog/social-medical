<div class="bg-gradient-to-r from-teal-500 via-indigo-500 to-purple-600 p-8 rounded-lg shadow-2xl text-white relative overflow-hidden">
    <!-- Iluminación animada -->
    <div class="absolute inset-0 bg-gradient-to-r from-white opacity-10 animate-pulse"></div>

    <div class="relative z-10">
        <!-- Título de la promoción -->
        <h2 class="text-3xl font-bold text-shadow-md text-2xl sm:text-3xl lg:text-4xl hover:text-yellow-400 transition duration-500 ease-in-out">
            {{ $promotion ? $promotion->title : 'Sin promociones actuales' }}
        </h2>
        <p class="mt-2 text-lg text-gray-200 transition duration-500 ease-in-out hover:text-yellow-300">
            {{ $promotion ? $promotion->description : 'Actualmente no hay ninguna promoción activa.' }}</p>

        <!-- Sección del cronómetro -->
        @if($promotion)
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <!-- Temporizador -->
                <div class="bg-black bg-opacity-50 p-4 rounded-xl text-center shadow-md transform transition duration-500 ease-in-out hover:scale-105">
                    <div id="countdown" class="font-bold text-gray-300  sm:text-2xl">
                        <span> <strong class="text-slate-100">Termina en:</strong> {{ $remainingTime }}</span>
                    </div>
                </div>

                <!-- Precio con descuento -->
                <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                    <span class=" font-semibold text-yellow-400">C${{ $promotion->discounted_price }}</span>
                    <span class="line-through text-sm text-gray-400">C${{ $promotion->original_price }}</span>
                </div>
            </div>

            <!-- Botón de suscripción con animación -->
            <div class="mt-6 text-center">
                <button class="bg-green-600 text-white py-2 px-6 rounded-full text-lg shadow-lg transform transition hover:scale-110 hover:bg-green-700 duration-300 ease-in-out">
                    Suscríbete
                </button>
            </div>
        @else
            <div class="mt-6 text-center">
                <p class="text-lg text-gray-400">¡No hay promociones activas en este momento!</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Actualiza el cronómetro en tiempo real
    setInterval(function() {
        @this.call('updateRemainingTime'); // Llama al método Livewire para actualizar el tiempo
    }, 1000);
</script>
