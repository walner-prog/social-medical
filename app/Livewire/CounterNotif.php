<?php

namespace App\Livewire;



use Livewire\Component;
use App\Models\Notification;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class CounterNotif extends Component
{

    
    public $appointments = []; // Almacenará las citas
    public $doctor;
    public $unreadCount = 0; // Cuenta las citas no leídas
    public $showAll = false; // Para mostrar todas las citas
    public $selectedAppointments = []; // Para manejar las citas seleccionadas para eliminar

public function mount()
    {
        $this->doctor = Auth::user(); // Obtener el doctor autenticado
        $this->loadAppointments();
    }

    // Cargar las citas del doctor
    public function loadAppointments()
    {
        $this->appointments = Appointment::where('doctor_id', $this->doctor->id)
                                          ->orderBy('created_at', 'desc')
                                          ->get();
        // Contar las citas no leídas (suponiendo que 'read' es un campo de las citas)
        $this->unreadCount = $this->appointments->where('read', false)->count();
    }

    // Ver más citas
    public function loadMore()
    {
        $this->showAll = true; // Mostrar todas las citas
    }

    // Marcar una cita como leída
    public function markAsRead($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->update(['read' => true]); // Marcar como leída
            $this->loadAppointments(); // Recargar las citas
        }
    }

    // Eliminar una cita
    public function deleteAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->delete(); // Eliminar la cita
            $this->loadAppointments(); // Recargar las citas
        }
    }

    // Eliminar citas seleccionadas
    public function deleteSelectedAppointments()
    {
        Appointment::whereIn('id', $this->selectedAppointments)->delete();
        $this->loadAppointments(); // Recargar las citas
    }



    public function render()
    {
        return view('livewire.counter-notif');
    }
}
