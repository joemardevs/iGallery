@php use App\Models\Artwork; @endphp
<div>
    <section class="text-gray-400 bg-gray-50 dark:bg-gray-900 overflow-hidden">
        <div class="container px-4 py-8 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                @if ($artworkImage)
                    <img class="lg:h-96 md:h-72 w-full object-cover object-center"
                        src="{{ env('APP_URL') . '/storage/' . $artworkImage }}" alt="artwork">
                @else
                    <img class="lg:h-96 md:h-72 w-full object-cover object-center" src="https://dummyimage.com/720x400"
                        alt="artwork">
                @endif
                <form method="get" action="{{ route('payment.confirmation', ['artwork' => $artwork]) }}"
                    class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    @csrf
                    @method('GET')
                    @if ($category)
                        <a href="{{ route('show.artworks.by.category', ['category' => $category]) }}"
                            class="text-sm text-gray-500">
                            {{ $category }}
                        </a>
                    @endif
                    <h1 class="text-gray-900 dark:text-gray-50 text-3xl font-medium mb-1">{{ $title }}
                    </h1>
                    <div class="flex mb-4">
                        <small>Created at {{ date('M d, Y', strtotime($createdDate)) }}</small>
                    </div>
                    <p class="text-justify">{{ $description }}</p>
                    <div class="mt-6 pb-2 mb-2">
                        <div class="flex items-center justify-between ">
                            <p class="mr-3">Size: {{ $size }}</p>
                        </div>
                        <div class="flex items-center justify-between ">
                            <p class="mr-3">Medium: {{ $medium }}</p>
                        </div>
                    </div>
                    <div class="flex mt-2 items-center justify-between pb-2">
                        <div>
                            @if ($artistName)
                                <p class="mr-3">Artist: <a
                                        href="{{ route('artist.profile', ['artist' => $artistName]) }}">{{ $artistName }}</a>
                                </p>
                            @endif
                            <p class="mr-3">Contact: {{ $contact }}</p>
                            <p class="mr-3">Address: {{ $address }}</p>
                        </div>
                        <p>₱{{ number_format($price) }}.00</p>
                    </div>
                    <div class="flex items-center gap-2 mt-2 pb-2 border-b dark:border-gray-700 mb-10">
                        @foreach (json_decode(html_entity_decode($theme)) as $themeOfArtwork)
                            <p>#{{ $themeOfArtwork }}</p>
                        @endforeach
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
                            @php
                                $getArtwork = Artwork::find($artwork);
                            @endphp
                            <button type="submit" {{ $getArtwork->is_sold ? "disabled='disabled'" : '' }}
                                class="bg-blue-500 p-2 rounded w-full text-gray-100 hover:bg-blue-600 hover:shadow-md {{ $getArtwork->is_sold ? 'bg-gray-500 hover:bg-gray-500' : 'Buy' }}">
                                {{ $getArtwork->is_sold ? 'This artwork was sold' : 'Buy' }}
                            </button>
                        @endif
                    @else
                        @php
                            $getArtwork = Artwork::find($artwork);
                        @endphp
                        <button type="submit" {{ $getArtwork->is_sold ? "disabled='disabled'" : '' }}
                            class="bg-blue-500 p-2 rounded w-full text-gray-100 hover:bg-blue-600 hover:shadow-md {{ $getArtwork->is_sold ? 'bg-gray-500 hover:bg-gray-500' : 'Buy' }}">
                            {{ $getArtwork->is_sold ? 'This artwork was sold' : 'Buy' }}
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </section>
</div>
