<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ArtworkCard extends Component
{
    public $artwork, $artworkImage, $category, $title, $description, $createdDate;
    public function mount($artwork)
    {
        $this->artwork = $artwork;
    }
    public function placeholder()
    {
        return view('livewire.components.card-lazy-loading-placeholder');
    }
    public function render()
    {
        return view('livewire.components.artwork-card');
    }
}
