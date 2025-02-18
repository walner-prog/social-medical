<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\DoctorLike;
use App\Models\Appointment;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DoctorDetail extends Component
{
    public $doctorId;
    public $doctor;
    public $rating;
    public $review;
    public $reviews = [];
    public $reviewsPerPage = 5; // Cantidad inicial de reseñas a cargar
    public $reviewsOffset = 0; // Offset para la paginación
    public $liked = false;
    public $likesCount;
    public $isModalOpen = false;  // Variable para controlar el modal
    public $appointment_datetime; 
    public  $patientName;  // Variable para la fecha de la cita
    public $perPage = 5;

   
    public function mount($doctorId)
    {
        $this->doctorId = $doctorId;
        $this->doctor = Doctor::with('user')->findOrFail($doctorId);
        $this->likesCount = DoctorLike::where('doctor_id', $this->doctorId)->count();

       $this->loadReviews();

       // Verificar si el usuario autenticado ya dio "me gusta"
       $user = auth()->user();
      if ($user) {
        $this->liked = DoctorLike::where('user_id', $user->id)
                                 ->where('doctor_id', $this->doctorId)
                                 ->exists();
      }
    }

    public function checkIfLiked()
    {
        $user = auth()->user();
        $this->liked = DoctorLike::where('user_id', $user->id)
                                 ->where('doctor_id', $this->doctorId)
                                 ->exists();
    }
    public function likeDoctor()
    {
        $user = auth()->user();

        // Verificar si el usuario tiene el rol 'patient'
        if ($user->role !== 'patient') {
            session()->flash('error', 'Solo los pacientes pueden dar "me gusta" a los doctores.');
            return;
        }

        // Verificar si ya existe un "me gusta" de este paciente para este doctor
        $existingLike = DoctorLike::where('user_id', $user->id)
                                  ->where('doctor_id', $this->doctorId)
                                  ->first();

        if ($existingLike) {
            // Si existe, eliminar el "me gusta"
            $existingLike->delete();
            $this->liked = false; // Actualizar estado local
            $this->likesCount--;  // Decrementar contador
        } else {
            // Si no existe, agregar un nuevo "me gusta"
            DoctorLike::create([
                'user_id' => $user->id,
                'doctor_id' => $this->doctorId,
            ]);
            $this->liked = true;  // Actualizar estado local
            $this->likesCount++;  // Incrementar contador
        }
    }

    

    public function loadReviews()
    {
        $this->reviews = $this->doctor->ratings()
            ->with('user') // Relaciona el usuario que envió la reseña
            ->latest() // Ordena desde la más reciente
            ->offset($this->reviewsOffset) // Empieza desde el offset
            ->limit($this->reviewsPerPage) // Carga un máximo de 5 reseñas
            ->get()
            ->toArray();
    }

    public function loadMoreReviews()
    {
        $this->reviewsOffset += $this->reviewsPerPage;
        $additionalReviews = $this->doctor->ratings()
            ->with('user')
            ->latest()
            ->offset($this->reviewsOffset)
            ->limit($this->reviewsPerPage)
            ->get()
            ->toArray();

        $this->reviews = array_merge($this->reviews, $additionalReviews); // Combina las reseñas existentes con las nuevas
    }

    public function submitRating()
    {

          // Verificar si el usuario es un paciente
          $user = auth()->user();
        if ($user->role !== 'patient') { // Suponiendo que 'role' es un campo en el modelo User que determina el tipo de usuario
            session()->flash('error', 'Solo los usuarios que no son médicos pueden calificar.
             Los médicos no deben calificar a otros médicos para evitar conflictos de interés. 
            Por favor, si tienes algún comentario, contáctanos directamente.');
         return;
        }


        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        $this->doctor->ratings()->create([
            'rating' => $this->rating,
            'review' => $this->review,
            'user_id' => auth()->id(),
        ]);

        $this->doctor->update([
            'average_rating' => $this->doctor->ratings()->avg('rating'),
            'reviews_count' => $this->doctor->ratings()->count(),
        ]);

        session()->flash('message', 'Tu calificación ha sido registrada.');

        // Limpia los campos del formulario
        $this->reset(['rating', 'review']);

        // Recarga las reseñas
        $this->reviewsOffset = 0;
        $this->loadReviews();
    }

  // Método para abrir o cerrar el modal
  public function toggleModal()
  {
      $this->isModalOpen = !$this->isModalOpen;
  }

  // Método para manejar el envío de la cita
  public function submitAppointment()
  {
      // Obtener el paciente correspondiente al usuario autenticado
      $patient = Patient::where('user_id', auth()->id())->first();
  
      // Verificar si el paciente existe
      if (!$patient) {
          // Si el paciente no existe, puedes manejar el error, por ejemplo, creando un nuevo paciente o mostrando un mensaje
          session()->flash('error', 'No se encontró un paciente asociado a tu cuenta. Por favor, regístrate como paciente.');
          return;
      }
  
      // Obtener el nombre del paciente a partir del modelo Patient
      $patientName = $patient->name;
  
      // Crear la cita con los datos correspondientes
      Appointment::create([
          'doctor_id' => $this->doctorId,
          'appointment_date' => $this->appointment_datetime,
          'patient_id' => $patient->id,  // Usar el ID del paciente desde la tabla 'patients'
          'patient_name' => $patientName,  // Asignar el nombre del paciente
      ]);
  
      session()->flash('message', 'Tu cita ha sido agendada con éxito.');
  
      // Cerrar el modal después de agendar
      $this->toggleModal();
  }
  
  
  public function loadMore()
  {
      $this->perPage += 5; // Incrementa las publicaciones mostradas
  }
  
    public function render()
    {
      
 // Asegúrate de que estás obteniendo el doctor por su ID y luego las publicaciones
 $doctor = Doctor::with('awards')->find($this->doctorId);

 $doctors = Doctor::where('specialty', $doctor->specialty)
 ->where('id', '!=', $doctor->id) // Excluir el doctor actual
 ->take($this->perPage)
 ->get();

 $certificates = Certificate::where('user_id', $doctor->user->id)->get();


    
 return view('livewire.doctor-detail', [
     'posts' => $doctor->user->posts()->take($this->perPage)->get() ,// Obtener publicaciones a través de user
     'doctors' => $doctors, 
     'certificates' => $certificates,
     'awards' => $doctor->awards,
 ]);
        
    }
}