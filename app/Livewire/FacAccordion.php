<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;

class FacAccordion extends Component
{
    public $questions;

    public function mount()
    {
        $this->questions = Question::all();
    }
    
    public function render()
    {
        return view('livewire.fac-accordion');
    }
}
