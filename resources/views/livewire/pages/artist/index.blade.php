@extends('livewire.layouts.app')
@section('title')
    {{ $artist->name }}
@endsection
@section('content')
    <div>
        <livewire:components.nav-bar />
        <div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4">
            <div class="py-4">
                <h1 class="text-2xl font-semibold text-center">{{ $artist->name }}</h1>
                <p>{{ $artistArtworks->count() > 2 ? 'Artworks' : 'Artwork' }}:</p>
            </div>
            <div class="md:grid grid-cols-4 gap-4">
                @foreach ($artistArtworks as $artistArtwork)
                    <a href="{{ route('show.artwork', ['artwork' => $artistArtwork]) }}">
                        <livewire:components.artwork-card :lazy='true' wire:key="{{ $artistArtwork->id }}"
                            artwork='{{ $artistArtwork }}' title='{{ $artistArtwork->title }}'
                            category='{{ $artistArtwork->category->name }}' createdDate='{{ $artistArtwork->created_date }}'
                            description='{{ $artistArtwork->description }}' />
                    </a>
                @endforeach
            </div>
            @if ($artistArtworks)
                <div class="my-8 z-0">
                    {{ $artistArtworks->links() }}
                </div>
            @endif
        </div>
        <livewire:components.footer />
    </div>
@endsection
