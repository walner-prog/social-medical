<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="max-w-md mx-auto bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">
    <div class="mb-4 text-sm text-white">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo danos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 bg-sky-600 text-slate-300" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-white" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Enviar enlace para restablecer la contraseña') }}
            </x-primary-button>
        </div>
    </form>
</div>

