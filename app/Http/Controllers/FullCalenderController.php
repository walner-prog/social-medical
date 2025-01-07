<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
  
class FullCalenderController extends Controller
{
    
    public function index(Request $request)
{
    try {
        if ($request->ajax()) {
            // Obtener el doctor_id enviado desde el frontend
            $doctor_id = $request->doctor_id;

            // Realizar la consulta base para obtener citas dentro del rango de fechas
            $query = Appointment::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->where('start', '>', now());  // Filtra las citas que están en el futuro
            // Si se proporciona un doctor_id, filtrar solo las citas de ese doctor
            if ($doctor_id) {
                $query->where('doctor_id', $doctor_id);
            }

            // Obtener las citas
            $appointments = $query->get(['id', 'title', 'start', 'end', 'doctor_id']);

            // Devolver las citas en formato JSON
            return response()->json($appointments);
        }

        // Obtener todos los doctores para pasarlos a la vista
        $doctors = Doctor::all();  // Asegúrate de tener el modelo Doctor configurado correctamente

        // Si no es una solicitud AJAX, simplemente renderizamos la vista
        return view('citasMedicas.appointmentCalendar', compact('doctors'));
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Ocurrió un error al obtener las citas.',
            'details' => $e->getMessage(),
        ], 500);
    }
}

    
    
    

public function ajax(Request $request): JsonResponse
{

    $validated = $request->validate([
        'type' => 'required|string|in:add,update,delete',
        'title' => 'required_if:type,add,update|string|max:255',
        'start' => 'required_if:type,add,update|date|before:end',
        'end' => 'required_if:type,add,update|date|after:start',
        'doctor_id' => 'required_if:type,add,update|exists:doctors,id',
        'patient_id' => 'required_if:type,add|exists:patients,id',
        'id' => 'required_if:type,update,delete|exists:appointments,id',
    ]);
    
    switch ($request->type) {
        case 'add':
            // Validar si el doctor está disponible
            $isAvailable = Appointment::where('doctor_id', $request->doctor_id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start', [$request->start, $request->end])
                          ->orWhereBetween('end', [$request->start, $request->end]);
                })->exists();

            if ($isAvailable) {
                return response()->json(['error' => 'El doctor no está disponible en este horario.'], 400);
            }

            $appointment = Appointment::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
            ]);

            return response()->json($appointment);
            break;

        case 'update':
            $appointment = Appointment::find($request->id);
            if (!$appointment) {
                return response()->json(['error' => 'Cita no encontrada.'], 404);
            }

            // Validar si el doctor está disponible en el nuevo horario
            $isAvailable = Appointment::where('doctor_id', $appointment->doctor_id)
                ->where('id', '!=', $appointment->id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start', [$request->start, $request->end])
                          ->orWhereBetween('end', [$request->start, $request->end]);
                })->exists();

            if ($isAvailable) {
                return response()->json(['error' => 'El doctor no está disponible en este horario.'], 400);
            }

            $appointment->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            return response()->json($appointment);
            break;

        case 'delete':
            $appointment = Appointment::find($request->id);
            if (!$appointment) {
                return response()->json(['error' => 'Cita no encontrada.'], 404);
            }

            $appointment->delete();
            return response()->json(['success' => 'Cita eliminada correctamente.']);

        default:
            return response()->json(['error' => 'Acción no válida.'], 400);

            break;
    }
}



}

/**
 * 
 *  
    public function index2(Request $request)
    {
               

        try {
            if ($request->ajax()) {
                $data = Appointment::whereDate('start', '>=', $request->start)
      ->whereDate('end', '<=', $request->end)
       ->get()
      ->map(function ($appointment) {
        return [
            'id' => $appointment->id,
            'title' => $appointment->title, // Solo el título
            'start' => $appointment->start, // Fecha/hora de inicio
            'end' => $appointment->end, // Fecha/hora de fin
            'formatted_start' => date('d-m-Y H:i', strtotime($appointment->start)), // Fecha/hora formateada de inicio
            'formatted_end' => date('d-m-Y H:i', strtotime($appointment->end)), // Fecha/hora formateada de fin
            'doctor_id' => $appointment->doctor_id,
            'patient_id' => $appointment->patient_id,
        ];
       });

          return response()->json($data);

     }
    
            return view('appointmentCalendar');
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al obtener las citas.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
 */