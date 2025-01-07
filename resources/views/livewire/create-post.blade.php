


<div class="container mx-auto p-6">


    <!-- Título y datos del doctor -->
    @if ($doctor)
    <div class="bg-white  dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
        <h1 class="text-3xl font-bold  text-gray-800 dark:text-gray-100">Bienvenido, Dr. {{ $doctor->user->name }}</h1>
        <p class="text-gray-600 mt-2"><strong>Especialidad:</strong> {{ $doctor->specialty }}</p>
        <p class="text-gray-600 mt-1"><strong>Años de experiencia:</strong> {{ $doctor->experience_years }}</p>
        <p class="text-gray-600 mt-1"><strong>Ciudad:</strong> {{ $doctor->city }}</p>
    </div>
@else
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Información del doctor no disponible.</h1>
    </div>
@endif

  
    <!-- Título de Citas Programadas -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-gray-100">Citas Programadas</h2>


@if (empty($appointments))
<p class="text-gray-600 dark:text-gray-100">No tienes citas programadas.</p>
@else
<!-- Tabla de citas -->
<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-100 text-gray-600">
                @if(auth()->user()->hasRole('doctor'))
                    <th class="px-4 py-2 text-left">Paciente</th>
                @elseif(auth()->user()->hasRole('patient'))
                    <th class="px-4 py-2 text-left">Doctor</th>
                @endif
                <th class="px-4 py-2 text-left">Fecha de la Cita</th>
                <th class="px-4 py-2 text-left">Detalles</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr class="border-b">
                    @if(auth()->user()->hasRole('doctor'))
                        <td class="px-4 py-2">{{ $appointment->patient->user->name ?? 'Paciente no disponible' }}</td>
                    @elseif(auth()->user()->hasRole('patient'))
                        <td class="px-4 py-2">{{ $appointment->doctor->user->name ?? 'Doctor no disponible' }}</td>
                    @endif
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}</td>
                     <td class="px-4 py-2">
                        <td class="px-4 py-2">
                            <button wire:click="showDetails({{ $appointment->id }})" class="text-blue-500 hover:text-blue-700 font-semibold">
                                Ver detalles
                            </button>
                        </td>
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($selectedAppointment)
        <div class="fixed inset-0 bg-white dark:bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-2xl font-bold mb-4 dark:text-gray-100">Detalle de la Cita</h2>

                <div>
                    <p><strong>Paciente:</strong> {{ $selectedAppointment->patient->user->name ?? 'Paciente no disponible' }}</p>
                    <p><strong>Doctor:</strong> {{ $selectedAppointment->doctor->user->name ?? 'Doctor no disponible' }}</p>
                    <p><strong>Fecha de la Cita:</strong> {{ \Carbon\Carbon::parse($selectedAppointment->appointment_date)->format('d/m/Y H:i') }}</p>
                    <p><strong>Detalles:</strong> {{ $selectedAppointment->details ?? 'No hay detalles disponibles' }}</p>
                </div>

                <button wire:click="closeModal" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Cerrar</button>
            </div>
        </div>
    @endif
</div>
@endif
<td class="px-4 py-2">{{ $appointment->doctor->user->name ?? 'doctor no disponible' }}</td>
<td class="px-4 py-2">{{ $appointment->patient->user->name ?? 'Paciente no disponible' }}</td>


</div>
