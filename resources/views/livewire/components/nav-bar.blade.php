<div>
    <nav x-data='{open : false}' class="w-screen sticky top-0 overflow-hidden">
        <div class="px-5 py-4 bg-blue-500 dark:bg-gray-700 flex items-center justify-between shadow-md">
            <a href="{{ route('home') }}">
                <h1 class="text-gray-50 font-extrabold font-merienda text-xl">{{ config('app.name') }}</h1>
            </a>
            <button @click="open = !open" type="button"
                class="w-10 h-10 grid place-items-center rounded hover:bg-gray-700">
                <svg class="w-6 h-6 text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <aside x-show="open"
            class="fixed backdrop-blur-sm top-0 right-0 h-screen w-screen text-gray-900 dark:text-gray-200 z-10"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-full"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-50" x-transition:leave-end="opacity-0 translate-x-full" x-cloak>
            <div
                class="absolute top-0 right-0 flex flex-col items-center gap-2 h-screen w-96 bg-gray-50 dark:bg-gray-700 shadow-md shadow-gray-500 p-4 py-6">
                <div class="flex justify-between w-80">
                    <button @click="open = !open" type="button"
                        class="w-10 h-10 grid place-items-center rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-6 h-6 text-gray-900 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div>
                        <livewire:components.toggle-theme />
                    </div>
                </div>
                <hr class="boder-gray-200 dark:border-gray-600 w-80">
                <h1 class="text-xl">{{ auth()->user()->name ?? 'Guest' }}</h1>
                <hr class="boder-gray-200 dark:border-gray-600 w-80">
                <div class="flex flex-col font-semibold justify-between h-screen">
                    <div class="flex flex-col items-center">
                        <a href="{{ route('home') }}" class="px-2 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                            <p class="p-2" @click="open = !open">Home</p>
                        </a>
                        <a href="{{ route('filter') }}" class="px-2 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                            <p class="p-2" @click="open = !open">Filter</p>
                        </a>
{{--                        @if (auth()->check() && auth()->user()->usertype == 'artist')--}}
{{--                            <a href="{{ route('upload.artwork.index') }}"--}}
{{--                                class="px-2 rounded hover:bg-gray-300 dark:hover:bg-gray-600">--}}
{{--                                <p class="p-2" @click="open = !open">Upload Artwork</p>--}}
{{--                            </a>--}}
{{--                        @endif--}}
                    </div>
                    <div class="flex justify-between w-80 pb-10">
                        @if (auth()->check())
                            <a href="{{ route('logout') }}"
                                class="p-2 hover:bg-gray-300 dark:hover:bg-gray-600 rounded flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                <p class="p-2" @click="open = !open">Logout</p>
                            </a>
                            <a href="{{ route('profile') }}"
                                class="p-2 hover:bg-gray-300 dark:hover:bg-gray-600 rounded flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.7" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="p-2" @click="open = !open">Profile</p>
                            </a>
                        @else
                            <a href="{{ route('sign-in') }}"
                                class="p-2 hover:bg-gray-300 dark:hover:bg-gray-600 rounded flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.7" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="p-2" @click="open = !open">Sign In</p>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </aside>
    </nav>
</div>
