@extends('livewire.layouts.app')
@section('title')
    Artwork
@endsection
@section('content')
    <livewire:components.nav-bar />
    <section class="text-gray-400 bg-gray-50 dark:bg-gray-900 overflow-hidden">
        <div class="container px-4 py-8 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    src="https://dummyimage.com/400x400">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    @if ($artwork->category)
                        <h2 class="text-sm text-gray-500">
                            {{ $artwork->category->name }}
                        </h2>
                    @endif
                    <h1 class="text-gray-900 dark:text-gray-50 text-3xl font-medium mb-1">{{ $artwork->title }}
                    </h1>
                    <div class="flex mb-4">
                        <small>Created at {{ date('M d, Y', strtotime($artwork->created_date)) }}</small>
                    </div>
                    <p class="text-justify">{{ $artwork->description }}</p>
                    <div class="flex mt-6 items-center justify-between pb-5 border-b dark:border-gray-700 mb-5">
                        <small class="mr-3">Artist: {{ $artwork->artist_name }}</small>
                        <small>₱ {{ $artwork->price }}.00</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <livewire:components.footer />
@endsection
