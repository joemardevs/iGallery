<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PrimaryButton extends Component
{
    public $label;
    public function mount($label)
    {
        $this->label = $label;
    }
    public function render()
    {
        return view('livewire.components.primary-button');
    }
}
