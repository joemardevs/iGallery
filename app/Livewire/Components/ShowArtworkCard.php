<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ShowArtworkCard extends Component
{
    public $artwork, $artworkImage, $category, $title, $createdDate, $description, $artistName, $price, $size, $medium, $contact, $address;
    public $theme = [];
    public function placeholder()
    {
        return view('livewire.components.show-lazy-loading-artwork-card');
    }
    public function render()
    {
        return view('livewire.components.show-artwork-card');
    }
}
