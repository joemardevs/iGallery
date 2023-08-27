@extends('livewire.layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <nav x-data='{open : false}' class="fixed w-screen">
        <div class=" p-2 bg-gray-800 flex justify-end">
            <button @click="open = !open" type="button" class="w-10 h-10 grid place-items-center rounded hover:bg-gray-700">
                <svg class="w-6 h-6 text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <aside x-show="open"
            class="fixed backdrop-blur-sm top-0 right-0 h-screen w-screen text-gray-900 dark:text-gray-200 z-10"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-full"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-50" x-transition:leave-end="opacity-0 translate-x-full" x-cloak>
            <div
                class="absolute top-0 right-0 flex flex-col items-center gap-4 h-screen w-96 bg-gray-50 dark:bg-gray-700 shadow-md shadow-gray-500 p-4 py-12">
                <h1 class="text-xl">{{ auth()->user()->name }}</h1>
                <button @click="open = !open" type="button"
                    class="w-10 h-10 grid place-items-center rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                    <svg class="w-6 h-6 text-gray-900 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="font-bold flex flex-col items-center gap-4">
                    <p>Home</p>
                    <a href="{{ route('logout') }}" class="">Logout</a>
                    <livewire:components.toggle-theme />
                </div>
            </div>
        </aside>
        <div class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-200 h-screen p-4 relative">
            <livewire:components.success-alert />
        </div>
    </nav>
@endsection
