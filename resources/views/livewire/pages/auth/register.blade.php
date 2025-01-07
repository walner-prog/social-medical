<?php

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Laravel\Socialite\Facades\Socialite; // Para Google
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public $avatar;
    public string $password_confirmation = '';
    public string $userRole = 'patient'; 

   
    public string $specialty = '';
    public string $city = '';
    public int $experience_years = 0;
    public $photo;
    public string $bio = '';
    public string $phone = '';
    public array $availability = [];

    /**
     * Handle an incoming registration request.
     */
     public function register()
{
    // Validar los datos de entrada
    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'userRole' => ['required', 'in:doctor,patient'], // Validar que sea un rol permitido
    ]);

    // Guardar la imagen si se sube
    $avatarPath = null;
    if ($this->avatar) {
        $avatarPath = $this->avatar->store('avatars', 'public'); 
    }

    // Validar los campos adicionales si es un doctor
    if ($this->userRole === 'doctor') {
        $this->validate([
            'specialty' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'bio' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:15'],
            'availability' => ['nullable', 'array'],
        ]);
    }

    // Hashear la contraseña
    $validated['password'] = Hash::make($validated['password']);

    // Crear el usuario
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'],
        'avatar' => $avatarPath,
        'registered' => true,
        'role' => $this->userRole, // Guardar el rol en la base de datos si se requiere
    ]);

    // Si es un doctor, crear la entrada correspondiente en la tabla 'doctors'
    if ($this->userRole === 'doctor') {
        Doctor::create([
            'user_id' => $user->id,
            'specialty' => $this->specialty,
            'city' => $this->city,
            'experience_years' => $this->experience_years,
            'bio' => $this->bio,
            'phone' => $this->phone,
            'availability' => json_encode($this->availability),
        ]);

                // Si es doctor y no tiene avatar, agregar la notificación
                if (!$user->avatar) {
            session()->flash('notification', [
                'message' => 'Como doctor, es recomendable que subas una foto de perfil para generar más confianza con los pacientes.',
                'type' => 'doctor'
            ]);
        }
    }


    

     if ($this->userRole === 'patient') {
        Patient::create([
            'user_id' => $user->id,
            'name' => $user->name,  // El nombre se puede copiar del usuario
            'email' => $user->email,
            'registered' => true, // El email también
        ]);

                // Notificación de bienvenida para pacientes
                session()->flash('notification', [
            'message' => 'Bienvenido a la plataforma. Tu cuenta ha sido creada con éxito. Disfruta de todos los beneficios de nuestros servicios.',
            'type' => 'patient'
        ]);

    }

    // Asignar el rol
    $user->assignRole($this->userRole);

    // Disparar el evento de registro
    event(new Registered($user));

    // Iniciar sesión con el nuevo usuario
    Auth::login($user);

    


    // Redirigir al dashboard
    $this->redirect(route('dashboard'));

   


}


    /**
     * Redirigir al usuario a la página de autenticación de Google.
     */
    public function redirectToGoogle()
    {
        return redirect(Socialite::driver('google')->stateless()->redirect()->getTargetUrl());
    }

    /**
     * Manejar la respuesta de Google y registrar o autenticar al usuario.
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'registered' => true, // Marcar como registrado
                'password' => Hash::make(uniqid()), // Contraseña aleatoria segura
            ]
        );

        $user->assignRole('patient'); // Rol predeterminado
        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="max-w-md mx-auto bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">
    <form wire:submit="register" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Dirección de correo electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-white" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-white" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full px-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

      

        <!-- Selector de Rol (Doctor o Paciente) -->
        <div>
            <label class="text-white">¿Eres doctor?</label>
            <input wire:model="userRole" type="radio" value="doctor" class="mr-2" /> Sí
            <input wire:model="userRole" type="radio" value="patient" class="mr-2" /> No
        </div>

        <!-- Campos de doctor, visibles si el usuario es doctor -->
        @if ($userRole === 'doctor')
            <div class="mt-4">
                <x-input-label for="specialty" :value="__('Especialidad')" class="text-white" />
                <x-text-input wire:model="specialty" id="specialty" class="block mt-1 w-full" type="text" required />
            </div>

            <div class="mt-4">
                <x-input-label for="city" :value="__('Ciudad')" class="text-white" />
                <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" required />
            </div>

            <div class="mt-4">
                <x-input-label for="experience_years" :value="__('Años de Experiencia')" class="text-white" />
                <x-text-input wire:model="experience_years" id="experience_years" class="block mt-1 w-full" type="number" required />
            </div>

            <div class="mt-4">
                <x-input-label for="bio" :value="__('Biografía')" class="text-white" />
                <textarea wire:model="bio" id="bio" class="block mt-1 w-full" rows="4"></textarea>
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Teléfono')" class="text-white" />
                <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" />
            </div>

            <div class="mt-4">
                <x-input-label for="availability" :value="__('Disponibilidad')" class="text-white" />
                <input wire:model="availability" type="checkbox" value="monday" /> Lunes
                <input wire:model="availability" type="checkbox" value="tuesday" /> Martes
                <!-- Más días de la semana -->
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('auth.google') }}" class="flex items-center bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
                <!-- Imagen del logo -->
                <img src="{{ asset('images/google.png') }}" alt="Logo de Google" class="w-6 h-6 mr-2">
                <!-- Texto del botón -->
                {{ __('Iniciar sesión con Google') }}
            </a>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-200 hover:text-gray-100 dark:hover:text-gray-400" href="{{ route('login') }}" wire:navigate>
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <x-primary-button class="ms-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</div>



