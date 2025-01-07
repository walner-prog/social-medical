<?php

namespace Http\Livewire;

use Livewire\Component;
use App\Events\NuevoMensaje;
use App\Models\Chat;
class ChatForm extends Component
{
    // Estas propiedades son publicas
    // y se pueden utilizar directamente desde la vista
    public $usuario;
    public $mensaje;

    // Generar datos para pruebas
    private $faker;
    
    // Mantenemos estos valores actualizados en 
    // la barra de direcciones...
    // Ej.: https://your-app.com/?usuario=Pedro
    protected $updatesQueryString = ['usuario'];   
    
    // Eventos Recibidos
    protected $listeners = ['solicitaUsuario'];

    // Cuando se Inicia el Componente (antes de Render)
    public function mount()
    {                
        $this->faker = \Faker\Factory::create();       
        $this->usuario = request()->query('usuario', $this->usuario) ?? $this->faker->name;
        $this->mensaje = $this->faker->realtext(20);

        dd($this->usuario);
    }
    
    
    // Cuando el otro componente nos solicitan el usuario    
    public function solicitaUsuario()
    {
        // Lo emitimos por evento
        $this->emit('cambioUsuario', $this->usuario);
    }

    // Cuando actualizamos el nombre de usuario
    public function updatedUsuario()
    {
        // Notificamos al otro componente el cambio
        $this->emit('cambioUsuario', $this->usuario);
    }

    // Se produce cuando se actualiza cualquier dato por Binding
    public function updated($field)
    {
        // Solo validamos el campo que genera el update
        $validatedData = $this->validateOnly($field, [
            'usuario' => 'required',
            'mensaje' => 'required',
        ]);
    }

    public function enviarMensaje()
    {
        $validatedData = $this->validate([
            'usuario' => 'required',
            'mensaje' => 'required',
        ]);
    
        Chat::create([
            'usuario' => $this->usuario,
            'mensaje' => $this->mensaje,
        ]);
    
        // Enviar evento a Pusher
        event(new NuevoMensaje($this->usuario, $this->mensaje));
    
        // Emitir evento al frontend
        $this->emit('enviadoOK', $this->mensaje);
    
        // Limpiar el campo mensaje
        $this->mensaje = '';
    }
    

    public function render()
    {
        return view('livewire.chat-form'), compact('hola');
    }
}