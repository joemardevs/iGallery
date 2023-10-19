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
            @foreach ($artworks as $artwork)
                <a href="{{ route('show.artwork', ['artwork' => $artwork]) }}">
                    <livewire:components.artwork-card :lazy='true' wire:key="{{ $artwork->id }}"
                        artwork='{{ $artwork }}' artworkImage="{{ $artwork->artwork_image }}"
                        title='{{ $artwork->title }}' category='{{ $artwork->category->name }}'
                        createdDate='{{ $artwork->created_date }}' description='{{ $artwork->description }}' />
                </a>
            @endforeach
        </div>
        @if ($artworks)
            <div class="my-8 z-0">
                {{ $artworks->links() }}
            </div>
        @endif
    </div>
    <livewire:components.footer />
@endsection
