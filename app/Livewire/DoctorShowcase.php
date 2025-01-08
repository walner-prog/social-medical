<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\DoctorLike;

class DoctorShowcase extends Component
{
    public $doctors;

    public function mount()
    {
        $this->doctors = Doctor::with('user')
            ->take(4) // Muestra solo 4 doctores
            ->get()
            ->map(function ($doctor) {
                $doctor->likesCount = DoctorLike::where('doctor_id', $doctor->id)->count();
                return $doctor;
            });
    }

    public function render()
    {
        return view('livewire.doctor-showcase', [
            'doctors' => $this->doctors,
        ]);
    }
}
