<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutButton extends Component
{
    public function logout()
    {
        // Cerrar la sesión del usuario actual
        Auth::guard('web')->logout();

        // Invalidar la sesión y regenerar el token CSRF
        Session::invalidate();
        Session::regenerateToken();

        // Redirigir al usuario a la página de login
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}
