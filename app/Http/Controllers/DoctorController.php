<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentNotification;

class DoctorController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            // Redirigir al login o mostrar un mensaje de error
            return redirect()->route('login')->withErrors(['error' => 'Debe iniciar sesión para acceder a esta página.']);
        }
    
        // Obtener el usuario autenticado
        $user = auth()->user();
    
         // Inicializar la variable de citas
    $appointments = collect();

    // Verificar si el usuario tiene el rol de doctor
    if ($user->hasRole('doctor')) {
        // Si es doctor, obtenemos las citas del doctor
        $appointments = Appointment::where('doctor_id', $user->id) // Usamos el ID del usuario directamente
                                  ->orderBy('created_at', 'desc')
                                  ->get();
    }
    // Verificar si el usuario tiene el rol de paciente
    elseif ($user->hasRole('patient')) {
        // Si es paciente, obtenemos las citas del paciente
        $appointments = Appointment::where('patient_id', $user->id) // Usamos el ID del usuario directamente
                                  ->orderBy('created_at', 'desc')
                                  ->get();
    } else {
        // Si el usuario no tiene rol de doctor o paciente
        abort(403, 'Acceso no autorizado.');
    }
    
        // Obtener información adicional del doctor si es necesario
        $doctor = $user->hasRole('doctor') && $user->doctor ? $user->doctor : null;
    
        // Retornar la vista donde se mostrarán las citas
        return view('doctores.index', compact('appointments', 'doctor'));
    }
    
    public function show($user)
    {
        if (!auth()->check()) {
            // Redirigir al login o mostrar un mensaje de error
            return redirect()->route('login')->withErrors(['error' => 'Debe iniciar sesión para acceder a esta página.']);
        }
        
        $doctor = Doctor::where('user_id', $user)->first();
    
        if (!$doctor) {
            abort(404);  // Si no se encuentra el doctor, lanzar error 404
        }
    
        return view('doctores.show', compact('doctor'));
    }
    
   

    public function showAppointments()
    {

        return view('doctores.citas_programadas');
    }

   
    public function uploadCertificate()
    {
        $doctor = Doctor::where('user_id', Auth::id())->first();
        
        if ($doctor) {
            // Si se encuentra el doctor, pasa los datos a la vista
            return view('doctores.certificados_logros', compact('doctor'));
        }
    
        // Si no se encuentra el doctor, redirige al login
        return redirect()->route('login')->withErrors('Debes iniciar sesión para continuar.');
    }
    


}
