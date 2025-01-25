<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;

class RelatedDoctors extends Component
{
    public $doctorId;
    public $perPage = 3; // Número de doctores por página
    public $city = ''; // Filtro por ciudad
    public $experienceYears = ''; // Filtro por años de experiencia

    public function mount($doctorId)
    {
        $this->doctorId = $doctorId;
    }

    public function render()
    {
        // Obtener el doctor actual
        $doctor = Doctor::findOrFail($this->doctorId);

        // Obtener doctores relacionados por especialidad, ciudad y experiencia
        $doctorsQuery = Doctor::where('specialty', $doctor->specialty)
                              ->where('id', '!=', $doctor->id); // Excluir el doctor actual
        
        // Filtrar por ciudad si se ha seleccionado
        if ($this->city) {
            $doctorsQuery->where('city', $this->city);
        }

        // Filtrar por años de experiencia si se ha seleccionado
        if ($this->experienceYears) {
            $doctorsQuery->where('experience_years', '>=', $this->experienceYears);
        }

        // Obtener los doctores con paginación
        $doctors = $doctorsQuery->take($this->perPage)->get();

        return view('livewire.related-doctors', [
            'doctors' => $doctors,
        ]);
    }

    // Método para cargar más doctores
    public function loadMore()
    {
        $this->perPage += 3;
        $this->render();
    }

    // Método para aplicar los filtros
    public function applyFilters()
    {
        $this->render();
    }
}
