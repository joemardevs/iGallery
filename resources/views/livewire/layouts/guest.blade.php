<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @yield('css')
</head>

<body class="font-poppins">
    @yield('content')
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
