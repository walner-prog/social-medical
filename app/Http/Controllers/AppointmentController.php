<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use App\Notifications\AppointmentNotification;


class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments.index');
    }
    
    
}
