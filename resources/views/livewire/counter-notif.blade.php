<div class="relative" x-data="{ open: false }">
    <!-- Icono de notificación y contador -->
    <button class="relative p-2" @click="open = !open">
        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22a2 2 0 002-2H10a2 2 0 002 2zm6-6V8a6 6 0 00-12 0v8l-2 2h16l-2-2z" />
        </svg>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 rounded-full bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center">{{ $unreadCount }}</span>
        @endif
    </button>

    <!-- Modal de citas -->
    <div x-show="open" @click.outside="open = false" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50 transition-opacity duration-300">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold mb-4">Citas</h3>

            <!-- Lista de citas -->
            <div class="space-y-3">
                @foreach($appointments->take($showAll ? count($appointments) : 5) as $appointment)
                    <div class="flex justify-between items-center border-b py-2">
                        <div>
                            <p class="{{ $appointment->read ? 'text-gray-500' : 'text-black font-semibold' }}">
                                {{ $appointment->patient_name }} - {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                            </p>
                            <small class="text-sm text-gray-400">{{ $appointment->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if(!$appointment->read)
                                <button wire:click="markAsRead({{ $appointment->id }})" class="text-blue-500 text-sm">Marcar como leída</button>
                            @endif
                            <button wire:click="deleteAppointment({{ $appointment->id }})" class="text-red-500 text-sm">Eliminar</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botón Ver Más -->
            @if(!$showAll)
                <button @click="open = false" wire:click="loadMore" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Ver más</button>
            @endif

            <!-- Botón para eliminar seleccionadas -->
            @if($selectedAppointments)
                <button wire:click="deleteSelectedAppointments" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Eliminar seleccionadas</button>
            @endif
        </div>
    </div>
</div>
