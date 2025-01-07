<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
new class extends Component
{

    use WithFileUploads;  // Agregar este trait

    public $avatar;  // Variable para almacenar el archivo

  
    public string $name = '';
    public string $email = '';
    public bool $isDoctor = false;

    public string $specialty = '';
    public string $city = '';
    public int $experience_years = 0;
    public ?string $bio = null;
    public ?string $phone = null;

    public ?string $certifications = null;
    public ?string $education = null;
    public ?string $languages = null;




public ?string $consultation_hours = null;  // Horario de consulta

     // Disponibilidad como un array asociativo
     public array $availability = [
        'monday' => ['start' => '', 'end' => ''],
        'tuesday' => ['start' => '', 'end' => ''],
        'wednesday' => ['start' => '', 'end' => ''],
        'thursday' => ['start' => '', 'end' => ''],
        'friday' => ['start' => '', 'end' => ''],
    ];

    /**
     * Mount the component.
     */
     public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

    // Asigna los valores del usuario a las propiedades de Livewire
   
    $this->avatar = $user->avatar;
    $this->specialty = $user->specialty ?? ''; // Si es un doctor
    $this->city = $user->city ?? ''; // Si es un doctor
    //$this->experience_years = $user->experience_years ?? ''; // Si es un doctor
    $this->bio = $user->bio ?? '';
    $this->phone = $user->phone ?? '';
    $this->availability = json_decode($user->availability, true) ?? [];
    $this->certifications = $user->certifications ?? '';
    $this->education = $user->education ?? '';
    $this->languages = $user->languages ?? '';
 
    $this->consultation_hours = $user->consultation_hours ?? '';
   
    

        

        // Verificar si el usuario tiene un registro en la tabla 'doctors'
        if ($user->doctor) {
            $this->isDoctor = true;

            $this->specialty = $user->doctor->specialty;
            $this->city = $user->doctor->city;
            $this->experience_years = $user->doctor->experience_years;
            $this->bio = $user->doctor->bio;
            $this->phone = $user->doctor->phone;
             // Decodificar la disponibilidad del JSON almacenado
        $this->availability = json_decode($user->doctor->availability, true) ?? [
            'monday' => ['start' => '', 'end' => ''],
            'tuesday' => ['start' => '', 'end' => ''],
            'wednesday' => ['start' => '', 'end' => ''],
            'thursday' => ['start' => '', 'end' => ''],
            'friday' => ['start' => '', 'end' => ''],
        ];
       // $this->availability = json_decode($user->availability, true) ?? [];
    $this->certifications = $user->doctor->certifications ?? '';
    $this->education = $user->doctor->education ?? '';
    $this->languages = $user->doctor->languages ?? '';
   // $this->linkedin = $user->linkedin ?? '';
   // $this->professional_profile = $user->professional_profile ?? '';
    $this->consultation_hours = $user->doctor->consultation_hours ?? '';
  // $this->social_links = json_decode($user->doctor->social_links, true) ?? [];
 

        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
     public function updateProfileInformation(): void
{
    try {
        $user = Auth::user();

        // Validar campos base
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:15'],
            'availability' => ['nullable', 'array'],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de avatar

            // Nuevos campos
            'certifications' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'languages' => ['nullable', 'string'],
           
            'consultation_hours' => ['nullable', 'string'],  // Horario de consulta
           // 'linkedin' => ['nullable', 'url'],  // Enlace de LinkedIn
        ]);

        // Guardar datos del usuario
        $user->fill($validated);

        // Si se ha cargado un nuevo avatar
        if ($this->avatar) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Si el usuario es doctor, actualizar la información
        if ($this->isDoctor) {
            $doctorValidated = $this->validate([
                'specialty' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'bio' => ['nullable', 'string'],
                 'phone' => ['nullable', 'string', 'max:15'],
                'experience_years' => ['required', 'integer', 'min:0'],
                'availability' => ['nullable', 'array'],
                
            ]);

            // Convertimos la disponibilidad a JSON antes de guardar
            $doctorValidated['specialty'] = $this->specialty;
            $doctorValidated['city'] = $this->city;
            $doctorValidated['bio'] = $this->bio;
            $doctorValidated['phone'] = $this->phone;
            $doctorValidated['experience_years'] = $this->experience_years;
            $doctorValidated['availability'] = json_encode($this->availability);
          

            // Nuevos campos del doctor
           // $doctorValidated['linkedin'] = $this->linkedin; // Guardar el enlace de LinkedIn
         //   $doctorValidated['social_links'] = $this->socialLinks ? json_decode($this->socialLinks, true) : null; // Redes sociales en formato JSON
            $doctorValidated['consultation_hours'] = $this->consultation_hours; // Horario de consulta
            $doctorValidated['certifications'] = $this->certifications;
            $doctorValidated['education'] = $this->education;
            $doctorValidated['languages'] = $this->languages;
           
            // Actualizar el modelo del doctor
            $user->doctor->update($doctorValidated);
        }

        $user->save();

        session()->flash('success', 'La información del perfil se ha actualizado correctamente.');
    } catch (\Exception $e) {
        session()->flash('error', 'Ocurrió un error al actualizar la información del perfil: ' . $e->getMessage());
    }
}




    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 p-8 rounded-xl shadow-lg">
    
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-white">
            {{ __("Actualiza la información de tu cuenta y la dirección de correo electrónico.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfileInformation" class="mt-6 space-y-6">
        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <x-text-input wire:model="name" id="name" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-white" />
            <x-text-input wire:model="email" id="email" type="email" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" class="text-white" />
            <input type="file" wire:model="avatar" id="avatar" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('avatar')" class="mt-2 text-red-400" />
        
            @if ($avatar && is_object($avatar))
                <!-- Vista previa para archivo temporal -->
                <div class="mt-2">
                    <p class="text-white">Vista previa:</p>
                    <img src="{{ $avatar->temporaryUrl() }}" class="mt-2 w-24 h-24 rounded-full" alt="Vista previa del avatar">
                </div>
            @elseif (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL))
                <!-- Avatar almacenado como URL (por ejemplo, de Google) -->
                <div class="mt-2">
                    <p class="text-white">Avatar actual:</p>
                    <img src="{{ Auth::user()->avatar }}" class="mt-2 w-24 h-24 rounded-full" alt="Avatar actual">
                </div>
            @elseif (Auth::user()->avatar && file_exists(public_path('storage/avatars/' . Auth::user()->avatar)))
                <!-- Avatar almacenado como archivo en public/avatars -->
                <div class="mt-2">
                    <p class="text-white">Avatar actual:</p>
                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="mt-2 w-24 h-24 rounded-full" alt="Avatar actual">
                </div>
            @else
                <!-- Sin avatar -->
                <div class="mt-2">
                    <p class="text-white">Avatar no disponible:</p>
                    <img src="https://via.placeholder.com/300" class="mt-2 w-24 h-24 rounded-full" alt="Avatar no disponible">
                </div>
            @endif
        </div>
        
        

        <!-- Campos adicionales para doctores -->
        @if ($isDoctor)
            <div>
                <x-input-label for="specialty" :value="__('Especialidad')" class="text-white" />
                <x-text-input wire:model="specialty" id="specialty" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('specialty')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="city" :value="__('Ciudad')" class="text-white" />
                <x-text-input wire:model="city" id="city" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('city')" class="mt-2 text-red-400" />
            </div>

            <div>
                <x-input-label for="experience_years" :value="__('Años de experiencia')" class="text-white" />
                <x-text-input wire:model="experience_years" id="experience_years" type="number" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('experience_years')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-4">
                <x-input-label for="bio" :value="__('Bio')" class="text-white" />
                <textarea wire:model="bio" id="bio" class="block mt-1 w-full rounded-md"></textarea>
                <x-input-error :messages="$errors->get('bio')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Teléfono')" class="text-white" />
                <x-text-input wire:model="phone" id="phone" type="text" class="block mt-1 w-full rounded-md" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-4">
                <x-input-label for="availability" :value="__('Disponibilidad')" class="text-white" />
                <div class="space-y-4">
                    @foreach (['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes'] as $day => $label)
                        <div class="flex items-center gap-4">
                            <label>
                                <input 
                                    wire:model="availability.{{ $day }}.active" 
                                    type="checkbox" 
                                    @if (!empty($availability[$day]['start']) && !empty($availability[$day]['end'])) checked @endif
                                /> 
                                {{ $label }}
                            </label>
                            <div class="flex items-center gap-2">
                                <x-text-input 
                                    wire:model="availability.{{ $day }}.start" 
                                    type="time" 
                                    class="mt-1 block w-24"
                                    value="{{ $availability[$day]['start'] ?? '' }}" 
                                    placeholder="Inicio"
                                />
                                <x-text-input 
                                    wire:model="availability.{{ $day }}.end" 
                                    type="time" 
                                    class="mt-1 block w-24"
                                    value="{{ $availability[$day]['end'] ?? '' }}" 
                                    placeholder="Fin"
                                />
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('availability')" class="mt-2 text-red-400" />


            </div>



            <div class="mt-4">
                <x-input-label for="certifications" :value="__('Certificaciones')" class="text-white" />
                <x-text-input wire:model="certifications" id="certifications" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('certifications')" class="mt-2 text-red-400" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="education" :value="__('Educación')" class="text-white" />
                <x-text-input wire:model="education" id="education" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('education')" class="mt-2 text-red-400" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="languages" :value="__('Idiomas')" class="text-white" />
                <x-text-input wire:model="languages" id="languages" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('languages')" class="mt-2 text-red-400" />
            </div>
    
          
    

    
            <div class="mt-4">
                <x-input-label for="consultation_hours" :value="__('Horario de Consulta')" class="text-white" />
                <x-text-input wire:model="consultation_hours" id="consultation_hours" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('consultation_hours')" class="mt-2 text-red-400" />
            </div>
    
  


     @endif

     
               @if (session()->has('success'))
               <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
             {{ session('success') }}
                </div>
                 @endif
 
             @if (session()->has('error'))
             <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
         {{ session('error') }}
              </div>
            @endif

        <!-- Botón Guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
            <x-action-message on="profile-updated" class="dark:text-emerald-50">
                {{ __('Guardado.') }}
            </x-action-message>
        </div>
    </form>
</section>


{{-- 
  <div class="mt-4">
                <x-input-label for="average_rating" :value="__('Promedio de Calificación')" class="text-white" />
                <x-text-input wire:model="average_rating" id="average_rating" type="number" step="0.1" min="0" max="5" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('average_rating')" class="mt-2 text-red-400" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="reviews_count" :value="__('Número de Reseñas')" class="text-white" />
                <x-text-input wire:model="reviews_count" id="reviews_count" type="number" min="0" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('reviews_count')" class="mt-2 text-red-400" />
            </div>

--}}