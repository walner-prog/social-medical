<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ThreadDetail extends Component
{
    public $thread;
    public $replyContent = ''; // Para el formulario de crear/editar respuestas
    public $editingReplyId = null; // ID de la respuesta en edición
    public $parentReplyId = null;
    public $openDropdown = null;


    protected $rules = [
        'replyContent' => 'required|min:5|max:500',
    ];

    public function mount($id)
    {
        $this->thread = Thread::with(['replies.replies.user', 'replies.user'])->findOrFail($id);
    }

    public function toggleDropdown($replyId)
    {
        if ($this->openDropdown === $replyId) {
            $this->openDropdown = null;
            $this->parentReplyId = null; // Cerrar el formulario de respuesta al desactivar el dropdown
        } else {
            $this->openDropdown = $replyId;
            $this->setReplyParent($replyId); // Establecer el ID de la respuesta como el parentReplyId
        }
    }

    public function createReply($parentId = null)
    {
        $this->validate();

        Reply::create([
            'content' => $this->replyContent,
            'thread_id' => $this->thread->id,
            'user_id' => Auth::id(),
            'parent_id' => $parentId ?? $this->parentReplyId,
        ]);

        $this->resetReplyForm();
        $this->refreshThread();

        session()->flash('message', '¡Respuesta creada con éxito!');
    }

    public function editReply($replyId)
    {
        $reply = Reply::findOrFail($replyId);

        // Asegurarse de que el usuario puede editar solo sus propias respuestas
        if ($reply->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para editar esta respuesta.');
            return;
        }

        // Verificar si han pasado más de 5 minutos
        if (Carbon::now()->diffInMinutes($reply->created_at) > 5) {
            session()->flash('error', 'Solo puedes editar una respuesta dentro de los primeros 5 minutos.');
            return;
        }

        $this->editingReplyId = $reply->id;
        $this->replyContent = $reply->content;
    }

    public function updateReply()
    {
        $this->validate();

        $reply = Reply::findOrFail($this->editingReplyId);

        if ($reply->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para editar esta respuesta.');
            return;
        }

        if (Carbon::now()->diffInMinutes($reply->created_at) > 5) {
            session()->flash('error', 'Solo puedes editar una respuesta dentro de los primeros 5 minutos.');
            return;
        }

        $reply->update(['content' => $this->replyContent]);

        $this->resetReplyForm();
        $this->refreshThread();

        session()->flash('message', '¡Respuesta actualizada con éxito!');
    }

    public function setReplyParent($replyId)
    {
        $this->parentReplyId = $replyId;
    }
   


    public function deleteReply($replyId)
    {
        $reply = Reply::findOrFail($replyId);

        if ($reply->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para eliminar esta respuesta.');
            return;
        }

        $reply->delete();

        $this->refreshThread();

        session()->flash('message', '¡Respuesta eliminada con éxito!');
    }

    public function resetReplyForm()
    {
        $this->replyContent = '';
        $this->editingReplyId = null;
        $this->parentReplyId = null;
    }

    

    public function refreshThread()
    {
        $this->thread = Thread::with(['replies.replies.user', 'replies.user'])->findOrFail($this->thread->id);
    }

    public function render()
    {
        return view('livewire.thread-detail');
    }
}