@extends('livewire.layouts.app')
@section('title')
    Artwork
@endsection
@section('content')
    <livewire:components.nav-bar />
    <div class="bg-gray-50 dark:bg-gray-900 p-4">
        @if ($artwork->category)
            <livewire:components.show-artwork-card :lazy="true" wire:key="{{ $artwork->id }}"
                artwork="{{ $artwork->id }}" artworkImage="{{ $artwork->artwork_image }}" title="{{ $artwork->title }}"
                category="{{ $artwork->category->name }}" description="{{ $artwork->description }}"
                artistName="{{ $artwork->artist->name }}" price="{{ $artwork->price }}" />
        @else
            <livewire:components.show-artwork-card :lazy="true" wire:key="{{ $artwork->id }}"
                artwork="{{ $artwork->id }}" artworkImage="{{ $artwork->artwork_image }}"
                description="{{ $artwork->description }}" title="{{ $artwork->title }}"
                artistName="{{ $artwork->artist->name }}" price="{{ $artwork->price }}" />
        @endif
    </div>
    <livewire:components.footer />
@endsection
