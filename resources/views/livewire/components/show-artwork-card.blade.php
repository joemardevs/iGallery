<div>
    <section class="text-gray-400 bg-gray-50 dark:bg-gray-900 overflow-hidden">
        <div class="container px-4 py-8 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                @if ($artworkImage)
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                        src="{{ env('APP_URL') . '/storage/' . $artworkImage }}" alt="artwork">
                @else
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="https://dummyimage.com/720x400"
                        alt="artwork">
                @endif
                <form method="get" action="{{ route('payment.confirmation', ['artwork' => $artwork]) }}"
                    class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    @csrf
                    @method('GET')
                    <a href="{{ route('show.artworks.by.category', ['category' => $category]) }}"
                        class="text-sm text-gray-500">
                        {{ $category }}
                    </a>
                    <h1 class="text-gray-900 dark:text-gray-50 text-3xl font-medium mb-1">{{ $title }}
                    </h1>
                    <div class="flex mb-4">
                        <small>Created at {{ date('M d, Y', strtotime($createdDate)) }}</small>
                    </div>
                    <p class="text-justify">{{ $description }}</p>
                    <div class="flex mt-6 items-center justify-between pb-5 border-b dark:border-gray-700 mb-5">
                        <small class="mr-3">Artist: <a
                                href="{{ route('artist.profile', ['artist' => $artistName]) }}">{{ $artistName }}</a></small>
                        <small>₱ {{ $price }}.00</small>
                    </div>
                    @if (auth()->check())
                        @if ($artistName == auth()->user()->name)
                            <div class="flex gap-12">
                                <a href="{{ route('delete.artwork', ['artwork' => $artwork]) }}"
                                    class="bg-red-500 p-2 rounded w-full text-gray-100 text-center hover:bg-red-600 hover:shadow-md">
                                    Delete
                                </a>
                                <a href="{{ route('edit.artwork', ['artwork' => $artwork]) }}"
                                    class="bg-blue-500 p-2 rounded w-full text-gray-100 text-center hover:bg-blue-600 hover:shadow-md">
                                    Edit
                                </a>
                            </div>
                        @else
                            <button type="submit"
                                class="bg-blue-500 p-2 rounded w-full text-gray-100 hover:bg-blue-600 hover:shadow-md">
                                Buy
                            </button>
                        @endif
                    @else
                        <button type="submit"
                            class="bg-blue-500 p-2 rounded w-full text-gray-100 hover:bg-blue-600 hover:shadow-md">
                            Buy
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </section>
</div>
