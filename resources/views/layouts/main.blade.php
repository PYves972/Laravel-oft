<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Oft Atelier') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9F8F3] font-sans antialiased text-gray-900">

    @include('layouts.navigation')

    <main class="w-full">
        @yield('content')
    </main>

    @include('layouts.footer')
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const nav = document.getElementById('main-nav');

            function toggleNavBackground() {
                if (window.scrollY > 20) {
                    nav.classList.remove('bg-transparent', 'border-transparent');
                    nav.classList.add('bg-[#F9F8F3]/95', 'backdrop-blur-md', 'border-gray-200/60', 'shadow-sm');
                } else {
                    nav.classList.remove('bg-[#F9F8F3]/95', 'backdrop-blur-md', 'border-gray-200/60', 'shadow-sm');
                    nav.classList.add('bg-transparent', 'border-transparent');
                }
            }

            toggleNavBackground();
            window.addEventListener('scroll', toggleNavBackground);
        });
    </script>
</body>
</html>
