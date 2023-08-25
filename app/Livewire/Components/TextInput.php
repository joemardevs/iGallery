<?php

namespace App\Livewire\Components;

use Livewire\Component;

class TextInput extends Component
{
    public $type, $placeholder, $name, $id, $autocomplete;
    // type="password" name="password" id="password" placeholder=""
    public function render()
    {
        return view('livewire.components.text-input');
    }
}
