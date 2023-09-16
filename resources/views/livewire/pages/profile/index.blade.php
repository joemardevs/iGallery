@extends('livewire.layouts.app')
@section('title')
    Profile
@endsection
@section('content')
    <livewire:components.nav-bar />
    <livewire:components.success-alert />
    <livewire:components.error-alert />
    @if ($errors->any())
        <div class="absolute top-5 right-5 bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-2 shadow-md"
            role="alert" x-data="{ show: true }" x-show='show' x-init="setTimeout(() => show = false, 3000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
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
    <main class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-200 p-4 flex flex-col gap-6">
        <form action="{{ route('profile.update', ['user' => $user]) }}" method="POST" class="flex flex-col">
            @csrf
            @method('PATCH')
            <h1 class="text-xl">Profile Information</h1>
            <small>Update your profile information and email address.</small>
            <div class="flex flex-col py-4">
                <label for="name" class="text-xs">
                    Name
                </label>
                <livewire:components.text-input type='text' name='name' id='name' value="{{ $user->name }}" />
                <label for="email" class="text-xs">
                    Email
                </label>
                <livewire:components.text-input type='email' name='email' id='email' value="{{ $user->email }}" />
            </div>
            <livewire:components.primary-button label="Save" />
        </form>
        <hr class="boder-gray-200 dark:border-gray-600 w-full">
        <form action="{{ route('profile.updatePassword', ['user' => $user]) }}" method="POST" class="flex flex-col">
            @csrf
            @method('PATCH')
            <h1 class="text-xl">Update Password</h1>
            <small>Do not share your password to stay secure.</small>
            <div class="flex flex-col py-4">
                <label for="current_password" class="text-xs">
                    Current Password
                </label>
                <livewire:components.text-input type='password' name='current_password' id='current_password' />
                <label for="password" class="text-xs">
                    New Password
                </label>
                <livewire:components.text-input type='password' name='new_password' id='new_password' />
                <label for="password" class="text-xs">
                    New Confirm Password
                </label>
                <livewire:components.text-input type='password' name='new_password_confirmation'
                    id='new_password_confirmation' />
            </div>
            <livewire:components.primary-button label="Save" />
        </form>
    </main>
@endsection
