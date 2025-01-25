<div>
    <h2 class="text-2xl font-bold mb-4 text-center">Gestión de Citas</h2>
   

    <h3 class="text-2xl font-bold mt-8 mb-4 text-center text-gray-800 bg-gradient-to-r from-blue-500 via-slate-500 to-indigo-500 text-transparent bg-clip-text drop-shadow-lg">
        Lista Detallada de Citas Programadas
    </h3>
    @if(Auth::user()->hasRole('patient'))
    <div class="overflow-x-auto rounded-lg shadow-lg 
        bg-gradient-to-tr from-gray-50 via-gray-100 to-gray-200 
        dark:bg-gradient-to-tr dark:from-gray-800 dark:via-gray-700 dark:to-gray-900 
        p-4 mb-4"> 
        <table class="min-w-full divide-y divide-gray-300 rounded-lg shadow-md bg-white">
            <thead class="bg-gradient-to-r from-blue-800 to-indigo-500 text-white ">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Título</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Médico</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Inicio</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Duración</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Estado</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($appointmentspatinet as $appointment)
                <tr class="hover:bg-gray-100 transition duration-200 dark:bg-gradient-to-tr dark:from-gray-800 dark:via-gray-700 dark:to-gray-900  ">
                    <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->title }}</td>
                    <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->doctor->user->name }}</td>
                    <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->start }}</td>
                    <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->duration }} horas</td>
                    <td class="px-4 py-2 text-md">
                        <span class="px-2 py-1 rounded-md text-white text-xs font-semibold
                            {{ $appointment->status == 'pendiente' ? 'bg-yellow-600' : ($appointment->status == 'completada' ? 'bg-green-600' : 'bg-red-400') }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-sm p-1">
                        @if(Auth::user()->hasRole('doctor'))
                        <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                            class="bg-gray-200 p-1 rounded-md text-xs focus:ring focus:ring-indigo-300">
                            <option value="pendiente" {{ $appointment->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="completada" {{ $appointment->status == 'completada' ? 'selected' : '' }}>Completada</option>
                            <option value="cancelada" {{ $appointment->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                        
                        @else
                        <button wire:click="edit({{ $appointment->id }})"
                                class="bg-gradient-to-r from-indigo-500 via-purple-500 to-blue-900 text-white px-2 py-1 mb-1 rounded-lg hover:bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-700 text-xs transition">Editar</button>
                        <button wire:click="delete({{ $appointment->id }})"
                                class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700 text-white px-2 py-1 mb-1 rounded-lg hover:bg-gradient-to-br from-indigo-900 via-purple-900 to-red-900 text-xs transition">Eliminar</button>
                        @endif
                    </td>
                </tr>
              
                @endforeach
            </tbody>
        </table>
    
        <div>
            {{ $appointmentspatinet->links() }}
        </div>
    </div>
    @endif


    @if(Auth::user()->hasRole('doctor'))
<div class="overflow-x-auto rounded-lg shadow-lg 
    bg-gradient-to-tr from-gray-50 via-gray-100 to-gray-200 
    dark:bg-gradient-to-tr dark:from-gray-800 dark:via-gray-700 dark:to-gray-900 
    p-4 mb-4"> 
    <table class="min-w-full divide-y divide-gray-300 rounded-lg shadow-md bg-white">
        <thead class="bg-gradient-to-r from-blue-800 to-indigo-500 text-white ">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Título</th>
                <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Paciente</th>
                <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Inicio</th>
                <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Duración</th>
                <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Estado</th>
                <th class="px-4 py-3 text-left text-sm font-semibold tracking-wide">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($appointmentsdoctor as $appointment)
            <tr class="hover:bg-gray-100 transition duration-200 dark:bg-gradient-to-tr dark:from-gray-800 dark:via-gray-700 dark:to-gray-900">
                <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->title }}</td>
                <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->patient->name }}</td>
                <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->start }}</td>
                <td class="px-4 py-2 text-md text-gray-800 dark:text-slate-300">{{ $appointment->duration }} horas</td>
                <td class="px-4 py-2 text-md">
                    <span class="px-2 py-1 rounded-md text-white text-xs font-semibold
                        {{ $appointment->status == 'pendiente' ? 'bg-yellow-600' : ($appointment->status == 'completada' ? 'bg-green-600' : 'bg-red-400') }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm p-1">
               
                  <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                      class="bg-gray-200 p-1 rounded-md text-xs focus:ring focus:ring-indigo-300">
                      <option value="pendiente" {{ $appointment->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                      <option value="completada" {{ $appointment->status == 'completada' ? 'selected' : '' }}>Completada</option>
                      <option value="cancelada" {{ $appointment->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                  </select>
                  
                  
                  <button wire:click="edit({{ $appointment->id }})"
                          class="bg-gradient-to-r from-indigo-500 via-purple-500 to-blue-900 text-white px-2 py-1 mb-1 rounded-lg hover:bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-700 text-xs transition">Editar</button>
                  <button wire:click="delete({{ $appointment->id }})"
                          class="bg-gradient-to-r from-indigo-700 via-purple-700 to-blue-700 text-white px-2 py-1 mb-1 rounded-lg hover:bg-gradient-to-br from-indigo-900 via-purple-900 to-red-900 text-xs transition">Eliminar</button>
                  
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $appointmentsdoctor->links() }}
    </div>
</div>
@endif


@if (session()->has('message'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


<form wire:submit.prevent="{{ $appointmentId ? 'update' : 'store' }}" class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-900 p-6 rounded-3xl text-white shadow-xl space-y-6">
    <div class="relative">
      <label for="title" class="absolute top-1 left-3 text-sm text-gray-400 transition-all transform scale-75 origin-top-left">Título</label>
      <input type="text" id="title" wire:model="title" placeholder="Título de la cita" class="bg-gray-800 border border-gray-700 rounded-md px-3 pt-6 pb-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
      @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
    @if(Auth::user()->hasRole('patient'))
    <div class="relative">
      <label for="doctor_id" class="absolute top-1 left-3 text-sm text-gray-400 transition-all transform scale-75 origin-top-left">Médico</label>
      <select id="doctor_id" wire:model="doctor_id" class="bg-gray-800 border border-gray-700 rounded-md px-3 pt-6 pb-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Seleccione un médico</option>
        @foreach($doctors as $doctor)
          <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
        @endforeach
      </select>
      @error('doctor_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
  
    @endif
    @if(Auth::user()->hasRole('doctor'))
    <div class="relative">
      <label for="doctor_id" class="absolute top-1 left-3 text-sm text-gray-400 transition-all transform scale-75 origin-top-left">Paciente</label>
      <select id="doctor_id" wire:model="doctor_id" class="bg-gray-800 border border-gray-700 rounded-md px-3 pt-6 pb-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">Seleccione un paciente</option>
        @foreach($patientsselect as $patient)
          <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
        @endforeach
      </select>
      @error('doctor_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
  
    @endif

    <div class="relative">
      <label for="start" class="absolute top-1 left-3 text-sm text-gray-400 transition-all transform scale-75 origin-top-left">Inicio</label>
      <input type="datetime-local" id="start" wire:model="start" class="bg-gray-800 border border-gray-700 rounded-md px-3 pt-6 pb-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
      @error('start') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
  
    <div class="relative">
      <label for="duration" class="absolute top-1 left-3 text-sm text-gray-400 transition-all transform scale-75 origin-top-left">Duración (horas)</label>
      <input type="number" id="duration" wire:model="duration" min="1" max="6" class="bg-gray-800 border border-gray-700 rounded-md px-3 pt-6 pb-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
      @error('duration') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>
  
    <div class="flex space-x-4">
      <button type="submit" class="bg-gradient-to-r from-blue-500 to-green-500 hover:from-green-500 hover:to-blue-500 text-white p-3 rounded-md shadow-lg"> 
        {{ $appointmentId ? 'Actualizar' : 'Crear' }}
      </button>
      <button type="button" wire:click="resetForm" class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-md">Cancelar</button>
    </div>
  </form>

</div>





  



  



</div>
