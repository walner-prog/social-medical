<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Producto;
use App\Models\Activity;
use App\Models\Appointment;
class HomeController extends Controller
{
    //

    public function index()
    {
        $totalDoctors = Doctor::count(); // Total de doctores
        $totalPatients = Patient::count(); // Total de pacientes
        $totalProducts = Producto::sum('precio'); // Ventas totales de productos (o el campo adecuado)
    
        // Si también necesitas actividades recientes
        $recentActivities = Activity::latest()->take(5)->get(); // Ajusta la consulta según sea necesario
          // Obtener los primeros 3 usuarios con su avatar
      //  $doctorsAvatar = Doctor::with('user')->limit(3)->get();
        $doctorsAvatar = Doctor::with('user')->orderBy('created_at')->skip(4)->take(3)->get();

        // Obtener el usuario autenticado
       $user = auth()->user();
      // $patients= Patient::all();

        return view('dashboard', compact('totalDoctors', 'totalPatients', 'totalProducts', 'recentActivities','doctorsAvatar'));


    }

   
    
}
