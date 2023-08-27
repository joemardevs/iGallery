<?php

namespace App\Livewire\Components;

use Livewire\Component;

class TextInput extends Component
{
    public $type, $placeholder, $name, $id, $autocomplete, $value;
    public function mount($type, $placeholder, $name, $id, $autocomplete)
    {
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->id = $id;
        $this->autocomplete = $autocomplete;
    }
    public function render()
    {
        return view('livewire.components.text-input');
    }
}
