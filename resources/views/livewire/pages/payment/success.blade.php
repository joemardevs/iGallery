@extends('livewire.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="bg-gray-50 text-gray-800 p-4 h-screen flex flex-col justify-center items-center">
        <livewire:components.success-alert />
        <div class="w-56">
            <div class="flex justify-center">
                <h1 class="text-xl font-bold">Payment Success</h1>
            </div>
            <hr class="boder-gray-200 dark:border-gray-600 mt-4 mb-8">
            <div class="flex justify-center animate-bounce transition ease-in-out text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-28 h-28">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <a href="{{ route('home') }}"
            class="bg-blue-500 p-2 rounded w-1/2 text-gray-100 text-center hover:bg-blue-600 hover:shadow-md mt-2">
            Ok
        </a>
    </div>
@endsection
