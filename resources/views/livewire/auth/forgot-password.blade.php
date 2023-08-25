@extends('livewire.layouts.guest')
@section('title')
    Password Reset
@endsection
@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 h-screen grid place-items-center">
        <section
            class="text-gray-700 dark:text-gray-100 border border-gray-300  dark:border-gray-700 bg-gray-200 dark:bg-gray-800 h-[325px] w-96 rounded-md">
            <form action="" method="get">
                @csrf
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold mb-1">Password Reset</h1>
                            <small>Please provide your email for password reset instructions. We'll send the details to your
                                inbox.</small>
                        </div>
                        <button class="toggle-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 hidden dark:block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 dark:hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                            </svg>
                        </button>
                    </div>
                    <hr class="mt-4 border-gray-300 dark:border-gray-500">
                    <div class="my-4">
                        <div class="flex flex-col">
                            <label for="email">Email <span class="text-red-500">*</span></label>
                            <livewire:components.text-input type='email' name='email' id='email'
                                placeholder='example@gmail.com' autocomplete='email' />
                        </div>
                        <div class="flex justify-center my-4">
                            <livewire:components.primary-button label='Send' />
                        </div>
                        <div class="flex items-center text-xs">
                            <p class="mt-[1px]">You already remember your password?</p>
                            <a href="{{ route('sign-in') }}" class="font-semibold ml-1 underline text-sm">
                                Sign in
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
