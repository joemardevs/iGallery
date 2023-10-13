@extends('livewire.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <livewire:components.nav-bar />
    <div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4">
        <livewire:components.success-alert />
        <h1 class="text-xl font-bold">Upload Artwork</h1>
        <span class="text-sm">Provide a information about your artwork below.</span>
        <hr class="boder-gray-200 dark:border-gray-600 my-4">
        <form action="{{ route('upload.artwork') }}" method="post" enctype="multipart/form-data" class="px-8">
            @csrf
            <div class="flex flex-col">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Required" value="{{ old('title') }}"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Required"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500"></textarea>
            </div>
            <div class="flex flex-col">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id"
                    class="text-sm px-4 py-2 my-2 rounded-md bg-gray-300 dark:bg-gray-600 text-gray-500 cursor-pointer">
                    <option value="">Select the category of the artwork</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" placeholder="Required" min="20"
                    value="{{ old('price') }}"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="created_date">Created Date</label>
                <input type="date" name="created_date" id="created_date"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="medium">Medium</label>
                <input type="text" name="medium" id="medium" placeholder="Optional" value="{{ old('medium') }}"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="size">Size</label>
                <input type="text" name="size" id="size" placeholder="Optional" value="{{ old('size') }}"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="artwork_image">Artwork Image</label>
                <input type="file" name="artwork_image" id="artwork_image"
                    class="text-sm my-2 rounded p-2 bg-gray-300 dark:bg-gray-600 focus:outline-none focus:outline-blue-500">
            </div>
            <div class="flex justify-center py-4">
                <livewire:components.primary-button label='Upload' />
            </div>
        </form>
        @if ($errors->any())
            <div class="absolute top-5 right-5 bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-2 shadow-md"
                role="alert" x-data="{ show: true }" x-show='show' x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2">
                <h1 class="text-left text-md font-bold">Error</h1>
                <hr class="border-red-400">
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-800">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <livewire:components.footer />
@endsection
