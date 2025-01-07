<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos otro.') }}
</div>

@if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
        {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
    </div>
@endif

<div class="mt-4 flex items-center justify-between">
    <x-primary-button wire:click="sendVerification">
        {{ __('Reenviar correo de verificación') }}
    </x-primary-button>

    <button wire:click="logout" type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
        {{ __('Cerrar sesión') }}
    </button>
</div>

