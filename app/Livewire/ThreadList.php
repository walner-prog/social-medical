<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;

class ThreadList extends Component
{
    public $search = ''; // Búsqueda por título
    public $filterSpecialty = ''; // Filtro por especialidad
    public $threads; // Almacenará los temas
    public $title = ''; // Para el formulario de crear/editar
    public $content = ''; // Para el formulario de crear/editar
    public $specialty = ''; // Para el formulario de crear/editar
    public $editingThreadId = null; // ID del tema en edición
    public $showForm = false; // Para mostrar/ocultar el formulario
    public $confirmingDelete = null; // ID del tema a eliminar

    protected $rules = [
        'title' => 'required|min:5|max:100',
        'content' => 'required|min:10',
        'specialty' => 'nullable|string|max:50',
    ];

    public function mount()
    {
        $this->loadThreads();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        $this->resetForm();
    }

    

    public function loadThreads()
    {
        $this->threads = Thread::query()
            ->when($this->filterSpecialty, fn($q) => $q->where('specialty', $this->filterSpecialty))
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->latest()
            ->get();
    }

    public function createThread()
    {
        $this->validate();

        Thread::create([
            'title' => $this->title,
            'content' => $this->content,
            'specialty' => $this->specialty,
            'user_id' => Auth::id(),
        ]);

        $this->resetForm();
        $this->loadThreads();
        $this->showForm = false;
        session()->flash('message', '¡Tema creado con éxito!');
    }

    public function editThread($threadId)
    {
        $thread = Thread::findOrFail($threadId);

        // Asegurarse de que el usuario puede editar solo sus propios temas
        if ($thread->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para editar este tema.');
            return;
        }

        $this->editingThreadId = $thread->id;
        $this->title = $thread->title;
        $this->content = $thread->content;
        $this->specialty = $thread->specialty;
        $this->showForm = true; 
    }

    public function updateThread()
    {
        $this->validate();

        $thread = Thread::findOrFail($this->editingThreadId);

        if ($thread->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para editar este tema.');
            return;
        }

        $thread->update([
            'title' => $this->title,
            'content' => $this->content,
            'specialty' => $this->specialty,
        ]);

        $this->resetForm();
        $this->loadThreads();
        $this->showForm = false;

        session()->flash('message', '¡Tema actualizado con éxito!');
    }

    public function confirmDelete($threadId)
    {
        $this->confirmingDelete = $threadId;
    }

    public function deleteThread()
    {
        $thread = Thread::findOrFail($this->confirmingDelete);

        if ($thread->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para eliminar este tema.');
            return;
        }

        $thread->delete();
        $this->confirmingDelete = null;
        $this->loadThreads();
        session()->flash('message', '¡Tema eliminado con éxito!');
    }

    
    public function resetForm()
    {
        $this->editingThreadId = null;
        $this->title = '';
        $this->content = '';
        $this->specialty = '';
    }

    public function viewThread($id)
    {
        return redirect()->to('/forum?thread_id=' . $id);
    }

    public function render()
    {
        return view('livewire.thread-list');
    }
}