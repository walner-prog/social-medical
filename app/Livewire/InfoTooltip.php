<?php

namespace App\Livewire;
use Livewire\Component;

class InfoTooltip extends Component
{
    public $count = 0; // Ejemplo: Contador
    public $info = []; // Información que mostrar

    // Método para cargar datos dinámicos
    public function loadData()
    {
        $this->count = rand(1, 100); // Simula un dato dinámico
        $this->info = [
            'title' => 'Información Importante',
            'details' => 'Esto es un ejemplo de datos dinámicos.',
            'date' => now()->format('d M Y')
        ];
    }

    public function render()
    {
        return view('livewire.info-tooltip');
    }
}
