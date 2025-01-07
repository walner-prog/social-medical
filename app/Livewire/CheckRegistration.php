<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CheckRegistration extends Component
{
    public $isRegistered = false;

    public function render()
    {
        // Verificar si el usuario está autenticado y registrado
        if (Auth::check()) {
            $user = Auth::user();
            $this->isRegistered = $user->registered ?? false;  // Asumimos que el campo 'registered' existe en la tabla users
        }

        // Pasar la propiedad isRegistered directamente a la vista desde el render()
        return view('livewire.check_registration', ['isRegistered' => $this->isRegistered]);
    }
}
