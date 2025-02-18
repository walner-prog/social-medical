<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DoctorAward;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorAwards extends Component
{
    public $award_name;
    public $awarding_institution;
    public $year;
    public $description;
    public $showForm = false;
    public $doctor; 
    public $selectedAward = null; 
    
    

    protected $rules = [
        'award_name' => 'required|string|max:255',
        'awarding_institution' => 'required|string|max:255',
        'year' => 'required|integer|digits:4',
        'description' => 'nullable|string|max:1000',
    ];

    public function mount()
    {
        // Obtener el doctor relacionado con el usuario autenticado
        $this->doctor = Doctor::where('user_id', Auth::id())->first();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm; // Alterna la visibilidad del formulario
    }

    // Método para guardar o actualizar un premio
    public function saveAward()
    {
        $this->validate();

        // Si estamos editando un premio existente
        if ($this->selectedAward) {
            $award = DoctorAward::find($this->selectedAward);
            $award->update([
                'award_name' => $this->award_name,
                'awarding_institution' => $this->awarding_institution,
                'year' => $this->year,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Premio actualizado exitosamente.');
        } else {
            // Si es un nuevo premio, lo creamos
            if ($this->doctor) {
                DoctorAward::create([
                    'doctor_id' => $this->doctor->id,
                    'award_name' => $this->award_name,
                    'awarding_institution' => $this->awarding_institution,
                    'year' => $this->year,
                    'description' => $this->description,
                ]);

                session()->flash('message', 'Premio guardado exitosamente.');
            } else {
                session()->flash('error', 'No se encontró un doctor asociado.');
            }
        }

        $this->resetForm(); // Limpiar los campos del formulario
        $this->toggleForm();
    }

    // Método para eliminar un premio
    public function deleteAward($id)
    {
        $award = DoctorAward::find($id);
        if ($award) {
            $award->delete();
            session()->flash('message', 'Premio eliminado exitosamente.');
        }
    }

    // Método para seleccionar un premio para editar
    public function editAward($id)
    {
        $award = DoctorAward::find($id);
        if ($award) {
            $this->selectedAward = $id;
            $this->award_name = $award->award_name;
            $this->awarding_institution = $award->awarding_institution;
            $this->year = $award->year;
            $this->description = $award->description;
            $this->showForm = true; // Mostrar el formulario para editar
        }
    }

    // Método para limpiar los campos del formulario
    public function resetForm()
    {
        $this->reset(['award_name', 'awarding_institution', 'year', 'description', 'selectedAward']);
    }

    public function render()
    {
        // Verificar que $this->doctor esté disponible
        $doctor = $this->doctor;

        if ($doctor) {
            $awards = DoctorAward::where('doctor_id', $doctor->id)->get();
        } else {
            $awards = collect(); // Si no hay doctor, devolvemos una colección vacía
        }

        return view('livewire.doctor-awards', compact('doctor', 'awards'));
    }
}
