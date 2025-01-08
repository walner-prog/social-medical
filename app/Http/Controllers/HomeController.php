<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Producto;
use App\Models\Activity;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Models\Appointment;
use App\Models\Promotion;
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
      

       $usersTimeline = User::select(
        DB::raw("DATE_FORMAT(created_at, '%b %d, %Y') as date"),
        DB::raw("COUNT(*) as total")
    )
    ->groupBy('date')
    ->orderBy('created_at', 'desc')
    ->take(6) // Limitar a los últimos 6 registros
    ->pluck('total', 'date');

        return view('dashboard', compact('totalDoctors',
         'totalPatients',
          'totalProducts',
           'recentActivities',
           'doctorsAvatar',
           'usersTimeline'));


    }

    public function promociones()
    {
        //$promotions = Promotion::where('end_date', '>', now())->get();
     
        $posts = Post::latest()->take(4)->get(); // Últimos 4 posts
        return view('promociones.index', compact('posts'));
    }

   
    
}
