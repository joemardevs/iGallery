@extends('livewire.layouts.app')
@section('title')
    Filter
@endsection
@section('content')
    <nav
        class="bg-blue-500 dark:bg-gray-700 text-gray-900 dark:text-gray-200 flex justify-between items-center px-4 py-4 shadow-md fixed top-0 w-screen">
        <h1 class="font-semibold text-gray-50">Filters</h1>
        <livewire:components.toggle-theme />
    </nav>
    <form action="{{ route('filter.artworks') }}" method="get"
        class="px-4 py-24 flex flex-col items-center gap-6 bg-gray-50 dark:bg-gray-900 h-screen">
        @csrf
        <div class="text-center">
            <small class="dark:text-gray-200">
                Select a category
            </small>
            <div>
                <select name="category" id="category"
                    class="px-4 py-2 my-2 rounded-md bg-gray-300 dark:bg-gray-600 text-gray-500 cursor-pointer" required>
                    <option value="" disabled>Click here to select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center">
            <small class="dark:text-gray-200">
                Price range
            </small>
            <div class="flex flex-col">
                <input type="number" name="minPrice" id="minPrice"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500"
                    min="0" placeholder='Min.'>
                <small class="dark:text-gray-200">to</small>
                <input type="number" name="maxPrice" id="maxPrice"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500"
                    min="0" placeholder='Max.'>
            </div>
        </div>
        <div class="flex flex-col items-center gap-4 py-8 fixed bottom-0">
            <livewire:components.primary-button label='Apply' />
            <a href="{{ route('home') }}">
                <button type="button" class="dark:text-gray-200">Back</button>
            </a>
        </div>
    </form>
@endsection
