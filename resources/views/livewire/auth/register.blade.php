@extends('livewire.layouts.guest')
@section('title')
    Register
@endsection
@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 h-screen grid place-items-center">
        <section
            class="text-gray-700 dark:text-gray-100 border border-gray-300  dark:border-gray-700 bg-gray-200 dark:bg-gray-800 w-96 rounded-md">
            <form action="" method="post">
                @csrf
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold mb-1">Sign Up</h1>
                            <small>Please register to continue our app.</small>
                        </div>
                        <livewire:components.toggle-theme />
                    </div>
                    <hr class="mt-4 border-gray-300 dark:border-gray-500">
                    <div class="mt-4">
                        <label for="usertype">Type of account</label>
                        <select name="usertype" id="usertype"
                            class="px-4 py-2 my-2 rounded-md bg-gray-300 dark:bg-gray-600 text-sm text-gray-500 cursor-pointer w-full"
                            required>
                            <option value="user">User</option>
                            <option value="artist">Artist</option>
                        </select>
                        <div class="flex flex-col">
                            <label for="name">Name <span class="text-red-600 dark:text-red-400">*</span></label>
                            <livewire:components.text-input type='text' name='name' id='name'
                                placeholder='Juan Dela Cruz' autocomplete='name' />
                        </div>
                        <div class="flex flex-col">
                            <label for="email">Email <span class="text-red-600 dark:text-red-400">*</span></label>
                            <livewire:components.text-input type='email' name='email' id='email'
                                placeholder='example@gmail.com' autocomplete='email' />
                        </div>
                        <div class="flex flex-col">
                            <label for="password">Password <span class="text-red-600 dark:text-red-400">*</span></label>
                            <livewire:components.text-input type='password' name='password' id='password'
                                placeholder='••••••••' autocomplete='current-password' />
                        </div>
                        <div class="flex justify-center my-4">
                            <livewire:components.primary-button label='Sign Up' />
                        </div>
                        <div class="flex items-center mt-8 text-xs">
                            <p class="mt-[1px]">Already have an account?</p>
                            <a href="{{ route('sign-in') }}" class="font-semibold ml-1 underline text-sm">
                                Sign in
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </section>
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
@endsection
