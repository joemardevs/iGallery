@extends('livewire.layouts.app')
@section('title')
    Filter
@endsection
@section('content')
    <nav
        class="bg-blue-500 dark:bg-gray-700 text-gray-900 dark:text-gray-200 flex justify-between items-center px-4 py-4 shadow-md fixed top-0 w-screen">
        <h1 class="font-semibold text-xl">Filters</h1>
        <livewire:components.toggle-theme />
    </nav>
    <main class="px-4 py-24 flex flex-col items-center gap-6 bg-gray-50 dark:bg-gray-900 h-screen">
        <div class="text-center">
            <small class="dark:text-gray-200">
                Select a category
            </small>
            <div>
                <select name="category" id="category"
                    class="px-4 py-2 my-2 rounded-md bg-gray-300 dark:bg-gray-600 text-gray-400">
                    <option value="">Click here to select category</option>
                    <option value="">Painting</option>
                    <option value="">Painting</option>
                    <option value="">Painting</option>
                    <option value="">Painting</option>
                </select>
            </div>
        </div>
        <div class="text-center">
            <small class="dark:text-gray-200">
                Price range
            </small>
            <div class="flex flex-col">
                <livewire:components.text-input type='number' name='minPrice' id='minPrice' placeholder='Min.'
                    autocomplete='number' />
                <span class="dark:text-gray-200">to</span>
                <livewire:components.text-input type='number' name='maxPrice' id='maxPrice' placeholder='Max.'
                    autocomplete='number' />
            </div>
        </div>
        <div class="flex flex-col items-center gap-4 py-8 fixed bottom-0">
            <livewire:components.primary-button label='Apply' />
            <a href="{{ route('home') }}">
                <button class="dark:text-gray-200">Back</button>
            </a>
        </div>
    </main>
@endsection
