<?php

namespace App\Livewire\Pages\PrivacyPolicy;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.privacy-policy.index')
            ->layout('livewire.layouts.app');
    }
}
