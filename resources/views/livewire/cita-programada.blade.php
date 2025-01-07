<div class="py-8 px-4 sm:px-6 lg:px-8">
    <!-- Citas Pendientes -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-slate-200">Citas Pendientes</h2>
        @if ($upcomingAppointments->isEmpty())
            <p class="text-gray-600">No tienes citas pendientes.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Nombre del Paciente</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($upcomingAppointments as $appointment)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $appointment->patient_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $appointment->appointment_date->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-blue-500 hover:text-blue-700">Ver detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $upcomingAppointments->links() }} <!-- Paginación -->
            </div>
        @endif
    </div>

    <!-- Historial de Citas -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-slate-200">Historial de Citas pasadas</h2>
        @if ($pastAppointments->isEmpty())
            <p class="text-gray-600">No tienes citas pasadas.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Nombre del Paciente</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pastAppointments as $appointment)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $appointment->patient_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $appointment->appointment_date->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-blue-500 hover:text-blue-700">Ver detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pastAppointments->links() }} <!-- Paginación -->
            </div>
        @endif
    </div>
</div>
