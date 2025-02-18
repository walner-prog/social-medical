<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Notifications\emailCita;

class PatientController extends Controller
{
    //

    public function index(Request $request)
    {
        $patient= User::find(2);
      
        $messages["hi"] = "Hola {$patient->name},";
        $messages["wish"] = "Te recordamos que tienes una cita programada ";
        
        
        $patient->notify(new emailCita($messages));
  
        
    }

    
    public function showAppointments()
    {
        
        return view('pacientes.citas_programadas');
    }
    
}
