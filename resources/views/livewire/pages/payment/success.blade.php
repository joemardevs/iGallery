@extends('livewire.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="bg-gray-50 text-gray-800 p-4 h-screen flex flex-col justify-center items-center">
        <livewire:components.success-alert />
        <div class="flex flex-col items-center w-[370px]" x-data="{ showReceipt: true }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                class="w-10 h-10 text-green-600 bg-green-100 p-2 rounded-full">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <small class="my-2 text-gray-400">iGallery</small>
            <h1 class="text-2xl font-bold">Payment Success!</h1>
            <small class="mt-2 text-gray-400">Your payment has been successfully done.</small>
            <hr class="w-full my-6">
            <table class="w-full border-separate border-spacing-y-4">
                <tbody>
                    <tr>
                        <td class="text-gray-400">Reference Number</td>
                        <td class="text-right">{{ $reference_number }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-400">Payment Time</td>
                        <td class="text-right">{{ $payment_time }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-400">Payment Method</td>
                        <td class="text-right">{{ $payment_method }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-400">Buyer</td>
                        <td class="text-right">{{ $buyer_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-400">Artwork</td>
                        <td class="text-right">{{ $artwork_name }}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="w-full my-2 border-dashed">
            <table class="w-full border-separate border-spacing-y-4">
                <tbody>
                    <tr>
                        <td class="text-gray-400">Amount</td>
                        <td class="text-right">PHP {{ ' ' . $amount }}</td>
                    </tr>
                </tbody>
            </table>
            <small class="mt-2 text-gray-400" x-init="setTimeout(() => showReceipt = false, 3000)" x-show="showReceipt">
                Screenshot this receipt.
            </small>
            <a href="{{ route('home') }}"
                class="bg-blue-500 p-2 rounded w-32 text-gray-100 text-center hover:bg-blue-600 hover:shadow-md mt-2">
                Ok
            </a>
        </div>
        {{-- <div class="w-56">
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
        </a> --}}
    </div>
@endsection
