<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')
    {{-- Poppins font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- AlpinesJS --}}
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @yield('css')
    @livewireStyles
</head>

<body class="font-poppins">
    @yield('content')
    @livewireScripts
</body>
@yield('script')
<script>
    (function() {
        const darkToggles = document.querySelectorAll(".toggle-dark");
        darkToggles.forEach(toggle => {
            toggle.addEventListener("click", () => {
                document.documentElement.classList.toggle("dark");
                const isDarkMode = document.documentElement.classList.contains("dark");
                localStorage.setItem("darkMode", isDarkMode ? "true" : "false");
            });
        });

        // Check if dark mode preference is saved and apply it on page load
        const savedDarkMode = localStorage.getItem("darkMode");
        if (savedDarkMode === "true") {
            document.documentElement.classList.add("dark");
        }
    })();
</script>

</html>
