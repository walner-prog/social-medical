<?php
 
namespace App\Livewire;
 


use Livewire\Component;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

 
class CreatePost extends Component
{
    
    
    public $appointments = [];
    public $doctor;
    public $selectedAppointment;

    public function mount()
    {
        $user = Auth::user();
        
        // Verificar si el usuario tiene el rol de 'doctor'
        if ($user->roles->contains('name', 'doctor')) {
            // Obtener citas relacionadas con el doctor usando el ID del doctor
            $this->appointments = Appointment::with('doctor.user') // Cargar relación doctor y user
                ->where('doctor_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Cargar detalles del doctor
            $this->doctor = Doctor::where('user_id', $user->id)->first(); // Cargar el detalle del doctor
        } 
        // Verificar si el usuario tiene el rol de 'patient'
        elseif ($user->roles->contains('name', 'patient')) {
            // Obtener citas relacionadas con el paciente usando el ID del paciente
            $this->appointments = Appointment::where('patient_id', $user->id)
                                              ->orderBy('created_at', 'desc')
                                              ->get();
        } 
        else {
            abort(403, 'Acceso no autorizado.');
        }
    }
    

     // Método para seleccionar una cita y mostrar el modal
     public function showDetails($appointmentId)
     {
         $this->selectedAppointment = Appointment::find($appointmentId); // Encuentra la cita seleccionada
     }
 
     // Método para cerrar el modal
     public function closeModal()
     {
         $this->selectedAppointment = null; // Resetear la cita seleccionada para cerrar el modal
     }

  
 
    public function render()
    {
        return view('livewire.create-post');
    }
}