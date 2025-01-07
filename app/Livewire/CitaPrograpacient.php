<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
class CitaPrograpacient extends Component
{
   
    use WithPagination;

    public function render()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar si el usuario tiene el rol "patient"
        if ($user->hasRole('patient')) {
            // Obtener citas futuras (pendientes) del usuario autenticado
            $upcomingAppointments = Appointment::where('patient_id', $user->id)
                                                ->where('start', '>', now())
                                                ->paginate(5);
    
            // Obtener citas pasadas (historial) del usuario autenticado
            $pastAppointments = Appointment::where('patient_id', $user->id)
                                             ->where('start', '<', now())
                                             ->paginate(5);

                $doctors = Doctor::all();                             
    
            return view('livewire.cita-prograpacient', compact('upcomingAppointments', 'pastAppointments','doctors'));
        } else {
            // Redirigir o mostrar un mensaje de error si el usuario no es un paciente
            return redirect()->route('unauthorized'); // Ajustar la ruta según tu aplicación
        }
    }
}
