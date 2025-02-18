<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\Doctor;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
class DoctorEvents extends Component
{
    
   
    public $title;
    public $start;
    public $end;
    public $description;
    public $location;
    public $hour;
    public $cost;
    public $audience;
    public $registration;
    public $selectedEvent = null;
    public $showForm = false;
    public $doctor;
    public $filter = 'activos'; 
    public $viewMode = 'list'; 
    public $orderBy = 'desc';
    public $orderByColumn = 'start';
  
    
    public $selectedEvents = [];  // Array de eventos seleccionados
    public $selectAll = false;
   

    use WithPagination;
    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'title' => 'required|string|max:255',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
        'description' => 'nullable|string',
        'location' => 'nullable|string',
        'hour' => 'nullable|string',
        'cost' => 'nullable|string',
        'audience' => 'nullable|string',
        'registration' => 'nullable|string',
    ];

    public function mount()
    {
        // Obtener el doctor asociado al usuario autenticado
        $this->doctor = Doctor::where('user_id', Auth::id())->first();
        
    }

    // Filtrar los eventos según el tipo seleccionado
public function filterEvents($filter)
{
    $this->filter = $filter;
}

// Cambiar la vista entre lista y cuadrícula
public function changeViewMode($view)
{
    $this->viewMode = $view;
}

public function changeOrder($column)
{
    // Si ya estamos ordenando por esta columna, cambiamos el orden (asc/desc)
    if ($this->orderByColumn === $column) {
        $this->orderBy = $this->orderBy === 'asc' ? 'desc' : 'asc';
    } else {
        // Si cambiamos la columna, el orden será 'asc' por defecto
        $this->orderByColumn = $column;
        $this->orderBy = 'asc';
    }

    // Recargamos la página para aplicar el orden
    $this->resetPage();
}




    public function toggleForm()
    {
        $this->resetForm();
        $this->showForm = !$this->showForm;
    }

    public function updatedSelectAll($value)
    {
        // Si se marca el checkbox "Select All", seleccionamos todos los eventos
        if ($value) {
            $this->selectedEvents = $this->events->pluck('id')->toArray();
        } else {
            // Si se desmarca, deseleccionamos todos
            $this->selectedEvents = [];
        }
    }
    


    public function saveEvent()
    {
        $this->validate();
    
        $data = [
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
            'description' => $this->description,
            'location' => $this->location,
            'hour' => $this->hour,
            'cost' => $this->cost,
            'audience' => $this->audience,
            'registration' => $this->registration,
        ];
    
        if ($this->selectedEvent) {
            $event = Event::find($this->selectedEvent);
            $event->update($data);
            session()->flash('message', 'Evento actualizado exitosamente.');
        } else {
            if ($this->doctor) {
                Event::create(array_merge($data, ['doctor_id' => $this->doctor->id]));
                session()->flash('message', 'Evento creado exitosamente.');
            } else {
                session()->flash('error', 'No se encontró un doctor asociado.');
            }
        }

        $this->resetForm();
        $this->toggleForm();
    }
    
    public function deleteEvent($id)
{
    $event = Event::find($id);
    if ($event) {
        $event->delete();
        session()->flash('message', 'Evento eliminado exitosamente.');
    } else {
        session()->flash('error', 'El evento no existe o ya fue eliminado.');
    }
}
    public function editEvent($id)
    {
        $event = Event::find($id);
        if ($event) {
            $this->selectedEvent = $id;
            $this->title = $event->title;
            $this->start = $event->start;
            $this->end = $event->end;
            $this->description = $event->description;  // Acceder directamente al campo description
            $this->location = $event->location;        // Acceder directamente al campo location
            $this->hour = $event->hour;                // Acceder directamente al campo hour
            $this->cost = $event->cost;                // Acceder directamente al campo cost
            $this->audience = $event->audience;        // Acceder directamente al campo audience
            $this->registration = $event->registration;  // Acceder directamente al campo registration
            $this->showForm = true;
        }
    }
    

    public function resetForm()
    {
        $this->reset([
            'title', 'start', 'end', 'selectedEvent', 
            'description', 'location', 'hour', 'cost', 'audience', 'registration'
        ]);
    }

    public function render()
    {
        $query = Event::query();
    
        // Filtrar por estado de los eventos
        if ($this->filter === 'activos') {
            $query->where('status', 'activo');
        } elseif ($this->filter === 'archivados') {
            $query->where('status', 'archivado');
        }
    
        // Aplicar el orden
        $query->orderBy($this->orderByColumn, $this->orderBy);
    
        // Paginación de eventos, con filtro por doctor si está definido
        $events = $this->doctor ? $query->where('doctor_id', $this->doctor->id)->paginate(3) : $query->paginate(3);
    
        return view('livewire.doctor-events', compact('events'));
    }
    
    

    
}
