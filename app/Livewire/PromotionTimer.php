<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionTimer extends Component
{
    public $promotion;
    public $remainingTime;

    public function mount()
    {
        // Intenta obtener la primera promoción activa
        $this->promotion = Promotion::where('end_date', '>', Carbon::now())
                                    ->orderBy('end_date', 'asc')
                                    ->first();

        // Si hay una promoción válida, actualiza el tiempo restante
        if ($this->promotion) {
            $this->updateRemainingTime();
        } else {
            // Si no hay promoción, puedes asignar un valor predeterminado o mostrar algo
            $this->remainingTime = "No hay promociones disponibles actualmente.";
        }
    }

    public function updateRemainingTime()
    {
        if ($this->promotion) {
            $endTime = Carbon::parse($this->promotion->end_date);
            $now = Carbon::now();
            
            // Calculamos la diferencia entre la fecha final y ahora
            $diff = $endTime->diff($now);
    
            // Formateamos el tiempo restante
            $this->remainingTime = $diff->format('%d días %Hh %Im %Ss');
        }
    }
    

    public function render()
    {
        $this->updateRemainingTime();  // Actualiza el tiempo restante cada vez que se renderice el componente
        return view('livewire.promotion-timer');
    }
}
