@extends('livewire.layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <livewire:components.nav-bar />
    <div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4">
        <livewire:components.success-alert />
        <h1 class="text-2xl text-center my-4 font-semibold">Home</h1>
        <hr class="dark:border-gray-700 mb-4">
        <div class="md:grid grid-cols-4 gap-4">
            @foreach ($artworks as $artwork)
                @if ($artwork->category)
                    {{-- Display this if there's a category on the artworks --}}
                    <a href="{{ route('show.artwork', ['artwork' => $artwork]) }}">
                        <livewire:components.artwork-card :lazy='true' wire:key="{{ $artwork->id }}"
                            artwork='{{ $artwork }}' title='{{ $artwork->title }}'
                            category='{{ $artwork->category->name }}' createdDate='{{ $artwork->created_date }}'
                            description='{{ $artwork->description }}' />
                    </a>
                @else
                    {{-- Otherwise display this if no category on the artworks --}}
                    <a href="{{ route('show.artwork', ['artwork' => $artwork]) }}">
                        <livewire:components.artwork-card :lazy='true' wire:key="{{ $artwork->id }}"
                            artwork='{{ $artwork }}' title='{{ $artwork->title }}'
                            createdDate='{{ $artwork->created_date }}' description='{{ $artwork->description }}' />
                    </a>
                @endif
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
