<div class=" p-6 ">
    <h2 class="text-xl font-semibold mb-4">Sugerencias Recibidas</h2>

    @foreach($suggestions as $suggestion)
        <div class="border-b pb-4 mb-4">
            
            <p class="text-gray-500"><strong>Usuario:</strong> Anónimo</p>
            <p class="text-gray-600"><strong>Sugerencia:</strong> {{ $suggestion->suggestion }}</p>
            <p class="text-sm text-gray-500">Enviado el {{ $suggestion->created_at->format('d/m/Y') }}</p>
        </div>
    @endforeach

    <!-- Paginación -->
    <div class="mt-6">
        {{ $suggestions->links() }}
    </div>
</div>

