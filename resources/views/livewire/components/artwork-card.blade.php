<div>
    <section class="text-gray-600 dark:text-gray-200">
        <div class="container mx-auto">
            <div class="flex flex-wrap -m-4">
                <div class="p-4 md:w-96 md:h-[410px] cursor-pointer">
                    <div
                        class="h-full border-2 border-gray-200 dark:border-gray-700 border-opacity-60 rounded-lg overflow-hidden hover:shadow-md hover:scale-105 transition ease-in-out duration-300">
                        @if ($artworkImage)
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                src="{{ env('APP_URL') . '/storage/' . $artworkImage }}" alt="artwork">
                        @else
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                src="https://dummyimage.com/720x400" alt="artwork">
                        @endif
                        {{-- {{ env('APP_URL') . '/storage/' . $artworkImage }} --}}
                        <div class="p-6">
                            <h2 class="text-xs font-medium text-gray-400 mb-1">
                                {{ $category }}
                            </h2>
                            <h1 class="text-xl font-medium text-gray-900 dark:text-gray-50">
                                {{ Str::limit($title, 8) }}
                            </h1>
                            <small>Created at {{ date('M d, Y', strtotime($createdDate)) }}</small>
                            <p class="leading-relaxed mb-3">{{ Str::limit($description, 40) }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
