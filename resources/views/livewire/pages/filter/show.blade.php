@extends('livewire.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <livewire:components.nav-bar />
    <div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4">
        <livewire:components.success-alert />
        <h1 class="text-2xl text-center my-4 font-semibold">{{ $title }}</h1>
        <hr class="dark:border-gray-700 mb-4">
        <div class="md:grid grid-cols-4 gap-4">
            @forelse ($artworks as $artwork)
                <a href="{{ route('show.artwork', ['artwork' => $artwork]) }}">
                    <livewire:components.show-artwork-card :lazy="true" wire:key="{{ $artwork->id }}"
                        artwork="{{ $artwork->id }}" artworkImage="{{ $artwork->artwork_image }}"
                        title="{{ $artwork->title }}" createdDate='{{ $artwork->created_date }}'
                        category="{{ $artwork->category->name }}" description="{{ $artwork->description }}"
                        artistName="{{ $artwork->artist->name }}" price="{{ $artwork->price }}" />
                </a>
            @empty
                <h1 class="text-center pb-80">No found</h1>
            @endforelse
        </div>
        @if ($artworks)
            <div class="my-8 z-0">
                {{ $artworks->links() }}
            </div>
        @endif
    </div>
    <livewire:components.footer />
@endsection
