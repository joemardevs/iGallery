<?php

namespace App\Livewire\Components;

use Livewire\Component;

class TextInput extends Component
{
    public $type, $placeholder, $name, $id, $autocomplete, $value;
    public function mount($type, $name, $id)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
    }
    public function render()
    {
        return view('livewire.components.text-input');
    }
}
