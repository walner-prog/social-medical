<div>
    <div class="mb-8">
        <h2 class="text-3xl mt-2 font-semibold text-gray-800 dark:text-slate-200 mb-4">Citas Pendientes</h2>
        @if ($upcomingAppointments->isEmpty())
            <p class="text-gray-300">No tienes citas pendientes.</p>
        @else
            <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-800">
                <table class="min-w-full text-left bg-gradient-to-r from-gray-800 to-gray-900 text-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-gray-300">
                            <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($upcomingAppointments as $appointment)
                            <tr class="hover:bg-gray-700 transition-all duration-200">
                                <td class="px-6 py-4 text-sm">{{ $appointment->doctor->user->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $appointment->doctor->specialty }}</td>
                                <td class="px-6 py-4 text-sm">{{ $appointment->start->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $upcomingAppointments->links() }}
            </div>
        @endif
    </div>
    
    <!-- Historial de Citas -->
    <div>
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-slate-200 mb-4">Historial de Citas</h2>
        @if ($pastAppointments->isEmpty())
            <p class="text-gray-300">No tienes citas pasadas.</p>
        @else
            <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-800">
                <table class="min-w-full text-left bg-gradient-to-r from-gray-800 to-gray-900 text-slate-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-gray-300">
                            <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pastAppointments as $appointment)
                            <tr class="hover:bg-gray-700 transition-all duration-200">
                                <td class="px-6 py-4 text-sm">{{ $appointment->doctor->user->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $appointment->doctor->specialty }}</td>
                                <td class="px-6 py-4 text-sm">{{ $appointment->start->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pastAppointments->links() }}
            </div>
        @endif
    </div>
</div>


