<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use Livewire\WithPagination;
class AppointmentManager extends Component

{
    use WithPagination;
    public $appointment, $doctors, $appointmentId;
    public $title, $doctor_id, $start, $duration, $status='pendiente';
    public $end;
    public $appointmentstate;
    public $patients;
    

    public function mount()
    {
        $this->doctors = Doctor::all();
        if (Auth::user()->hasRole('doctor')) {
            $this->patients = User::role('patient')->get(); // Asumiendo que usas Spatie Roles
        }
    
        if (Auth::user()->hasRole('patient')) {
            $this->doctors = Doctor::with('user')->get();
        }
        
      
    }

    public function updateStatus($appointmentId, $status)
    {
        // Buscar la cita por su ID
        $appointmentstate = Appointment::find($appointmentId);
    
        // Validar que la cita exista
        if ($appointmentstate) {
            $appointmentstate->status = $status;
            $appointmentstate->save();
            

        } else {
            // Manejar el caso donde la cita no exista (opcional)
            session()->flash('error', 'Cita no encontrada.');
        }
    }
    

    public function render()
    {
         // Cargar los datos paginados solo en el render
    $appointmentspatinet = Appointment::where('patient_id', Auth::id())->paginate(3);
    
    $appointmentsdoctor = Appointment::where('doctor_id', Auth::id())->paginate(3);

    $patientsselect = Patient::all();
    return view('livewire.appointment-manager', [
        'appointmentspatinet' => $appointmentspatinet,
        'appointmentsdoctor' => $appointmentsdoctor,
        'patientsselect' => $patientsselect,
    ]);
    }

    public function resetForm()
    {
        $this->title = '';
        $this->doctor_id = '';
        $this->start = '';
        $this->duration = '';
        $this->status = 'pendiente';
        $this->end = null;
        $this->appointmentId = null;
    }
    public function store()
    {
        // Validar los datos
        $this->validate([
            'title' => 'required|string|max:255',
            'doctor_id' => 'required|exists:doctors,id',
            'start' => 'required|date',
            'duration' => 'required|integer|min:1|max:6',
        ]);

         // Verificar que la cita no sea en el mismo día
        if (strtotime($this->start) < strtotime('tomorrow')) {
        session()->flash('error', 'No puedes crear una cita para hoy. La cita debe ser para una fecha futura.');
        return;
        }

        $workStart = '07:59';
        $workEnd = '17:01';
        $lunchStart = '12:00';
        $lunchEnd = '13:00';
        $maxAppointmentsPerDay = 5; // Define el número máximo de citas que un doctor puede tener por día
        
        // Obtener solo la hora y minuto de la cita
        $citaStartTime = date('H:i', strtotime($this->start));
        
        // Validación de hora de trabajo (fuera de horario laboral)
        if (strtotime($citaStartTime) < strtotime($workStart) || strtotime($citaStartTime) > strtotime($workEnd)) {
            session()->flash('error', 'La cita debe ser dentro del horario laboral.');
            return;
        }
        
        // Validación de la hora de almuerzo (evitar citas entre las 12:00 y las 13:00)
        if (strtotime($citaStartTime) >= strtotime($lunchStart) && strtotime($citaStartTime) < strtotime($lunchEnd)) {
            session()->flash('error', 'No se pueden agendar citas durante la hora de almuerzo (12:00 - 13:00).');
            return;
        }
        
        // Verificar si el doctor ha alcanzado el límite de citas para ese día
        $appointmentsCount = Appointment::where('doctor_id', $this->doctor_id)
            ->whereDate('start', '=', date('Y-m-d', strtotime($this->start))) // Filtrar por la misma fecha
            ->count();
        
        if ($appointmentsCount >= $maxAppointmentsPerDay) {
            session()->flash('error', 'El doctor ya ha alcanzado el límite de citas para este día.');
            return;
        }


    
        // Calcular la hora de finalización
        $this->end = date('Y-m-d H:i:s', strtotime($this->start . " + $this->duration hours"));
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar el rol del usuario
        if ($user->role != 'patient') {
            session()->flash('error', 'Solo los pacientes pueden crear citas.');
            return;
        }
        
        
        // Validar que no haya conflictos de horarios para el doctor y el paciente
        $existingDoctorAppointment = Appointment::where('doctor_id', $this->doctor_id)
            ->where(function($query) {
                $query->whereBetween('start', [$this->start, $this->end])
                      ->orWhereBetween('end', [$this->start, $this->end])
                      ->orWhere(function ($query) {
                          $query->where('start', '<', $this->end)
                                ->where('end', '>', $this->start);
                      });
            })
            ->exists();
    
            if ($existingDoctorAppointment) {
                session()->flash('error', 'El doctor ya tiene una cita en este horario.');
              
                return;
            }
    
        // Validar que el paciente no tenga otra cita en el mismo horario
        $existingPatientAppointment = Appointment::where('patient_id', $user->id)
            ->where(function($query) {
                $query->whereBetween('start', [$this->start, $this->end])
                      ->orWhereBetween('end', [$this->start, $this->end])
                      ->orWhere(function ($query) {
                          $query->where('start', '<', $this->end)
                                ->where('end', '>', $this->start);
                      });
            })
            ->exists();
    
            if ($existingPatientAppointment) {
                session()->flash('error', 'Ya tienes una cita programada en este horario.');
             
                return;
            }


            $duplicateAppointment = Appointment::where('doctor_id', $this->doctor_id)
            ->where('patient_id', $user->id)
            ->where('start', $this->start)
           ->exists();

             
           if ($duplicateAppointment) {
            session()->flash('error', 'Ya tienes una cita programada en este horario con este doctor.');
            return;
        }

    
        // Crear la cita
        $appointment = Appointment::create([
            'patient_id' => $user->id,
            'doctor_id' => $this->doctor_id,
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
            'duration' => $this->duration,
            'status' => $this->status,
        ]);
    
        // Restablecer el formulario
        $this->resetForm();
        $this->appointment = Appointment::where('patient_id', Auth::id())->get();
        session()->flash('message', 'Cita creada con éxito.');
     
    }
    

    

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->appointmentId = $appointment->id;
        $this->title = $appointment->title;
        $this->doctor_id = $appointment->doctor_id;
        $this->start = $appointment->start;
        $this->duration = $appointment->duration;
        $this->status = $appointment->status;
    }

    public function update()
    {
        // Validar los datos
        $this->validate([
            'title' => 'required|string|max:255',
            'doctor_id' => 'required|exists:doctors,id',
            'start' => 'required|date',
            'duration' => 'required|integer|min:1|max:6',
        ]);

         // Verificar que la cita no sea en el mismo día
         if (strtotime($this->start) < strtotime('tomorrow')) {
            session()->flash('error', 'No puedes crear una cita para hoy. La cita debe ser para una fecha futura.');
            return;
            }
    
            $workStart = '07:59';
            $workEnd = '17:01';
            $lunchStart = '12:00';
            $lunchEnd = '13:00';
            $maxAppointmentsPerDay = 5; // Define el número máximo de citas que un doctor puede tener por día
            
            // Obtener solo la hora y minuto de la cita
            $citaStartTime = date('H:i', strtotime($this->start));
            
            // Validación de hora de trabajo (fuera de horario laboral)
            if (strtotime($citaStartTime) < strtotime($workStart) || strtotime($citaStartTime) > strtotime($workEnd)) {
                session()->flash('error', 'La cita debe ser dentro del horario laboral.');
                return;
            }
            
            // Validación de la hora de almuerzo (evitar citas entre las 12:00 y las 13:00)
            if (strtotime($citaStartTime) >= strtotime($lunchStart) && strtotime($citaStartTime) < strtotime($lunchEnd)) {
                session()->flash('error', 'No se pueden agendar citas durante la hora de almuerzo (12:00 - 13:00).');
                return;
            }
            
            // Verificar si el doctor ha alcanzado el límite de citas para ese día
            $appointmentsCount = Appointment::where('doctor_id', $this->doctor_id)
                ->whereDate('start', '=', date('Y-m-d', strtotime($this->start))) // Filtrar por la misma fecha
                ->count();
            
            if ($appointmentsCount >= $maxAppointmentsPerDay) {
                session()->flash('error', 'El doctor ya ha alcanzado el límite de citas para este día.');
                return;
            }
    
    
        
    
        // Calcular la hora de finalización
        $this->end = date('Y-m-d H:i:s', strtotime($this->start . " + $this->duration hours"));
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar el rol del usuario
        if ($user->role != 'patient') {
            session()->flash('error', 'Solo los pacientes pueden crear citas.');
            return;
        }
    
        // Validar que no haya conflictos de horarios para el doctor
        $existingDoctorAppointment = Appointment::where('doctor_id', $this->doctor_id)
            ->where(function($query) {
                $query->whereBetween('start', [$this->start, $this->end])
                      ->orWhereBetween('end', [$this->start, $this->end])
                      ->orWhere(function ($query) {
                          $query->where('start', '<', $this->end)
                                ->where('end', '>', $this->start);
                      });
            })
            ->where('id', '!=', $this->appointmentId) // Excluir la cita actual
            ->exists();
    
        if ($existingDoctorAppointment) {
            session()->flash('error', 'El doctor ya tiene una cita en este horario.');
            return;
        }
    
        // Validar que el paciente no tenga otra cita en el mismo horario
        $existingPatientAppointment = Appointment::where('patient_id', $user->id)
            ->where(function($query) {
                $query->whereBetween('start', [$this->start, $this->end])
                      ->orWhereBetween('end', [$this->start, $this->end])
                      ->orWhere(function ($query) {
                          $query->where('start', '<', $this->end)
                                ->where('end', '>', $this->start);
                      });
            })
            ->where('id', '!=', $this->appointmentId) // Excluir la cita actual
            ->exists();
    
        if ($existingPatientAppointment) {
            session()->flash('error', 'Ya tienes una cita programada en este horario.');
            return;
        }
    
        // Buscar y actualizar la cita
        $appointment = Appointment::findOrFail($this->appointmentId);
        $appointment->update([
            'title' => $this->title,
            'doctor_id' => $this->doctor_id,
            'start' => $this->start,
            'end' => $this->end,
            'duration' => $this->duration,
            'status' => $this->status,
        ]);
    
        // Restablecer el formulario
        $this->resetForm();
        $this->appointment = Appointment::where('patient_id', Auth::id())->get();
        session()->flash('message', 'Cita actualizada con éxito.');
    }
    

    public function delete($id)
    {
        Appointment::findOrFail($id)->delete();
        $this->appointment = Appointment::where('patient_id', Auth::id())->get();
        session()->flash('message', 'Cita eliminada con éxito.');
    }
}
