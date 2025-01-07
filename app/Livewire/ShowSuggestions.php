<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Suggestion;
use Livewire\WithPagination;

class ShowSuggestions extends Component
{
    use WithPagination; // Habilita la paginación para las sugerencias

    protected $paginationTheme = 'tailwind'; // Establece el tema de paginación

    public function render()
    {
        // Obtener las sugerencias paginadas
        $suggestions = Suggestion::latest()->paginate(5);

        return view('livewire.show-suggestions', compact('suggestions'));
    }
}
