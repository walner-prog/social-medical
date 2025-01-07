<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class CitaProgramada extends Component
{
    public function render()
    {
        // Cargar los datos paginados solo en el render
   
// Obtener citas futuras del usuario autenticado con paginación
$upcomingAppointments = Appointment::where(function ($query) {
    if (Auth::user()->hasRole('doctor')) {
        $query->where('doctor_id', Auth::id());
    } elseif (Auth::user()->hasRole('patient')) {
        $query->where('patient_id', Auth::id());
    }
})
->where('start', '>', now())
->paginate(5); // Paginación de 5 citas por página

// Obtener citas pasadas (historial) del usuario autenticado con paginación
$pastAppointments = Appointment::where(function ($query) {
    if (Auth::user()->hasRole('doctor')) {
        $query->where('doctor_id', Auth::id());
    } elseif (Auth::user()->hasRole('patient')) {
        $query->where('patient_id', Auth::id());
    }
})
->where('start', '<', now())
->paginate(5); // Paginación de 5 citas por página


        return view('livewire.cita-programada', compact('upcomingAppointments', 'pastAppointments'));
    }
}