<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PrimaryButton extends Component
{
    public $label;
    public function render()
    {
        return view('livewire.components.primary-button');
    }
}
