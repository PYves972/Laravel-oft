<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen bg-gray-50">
        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-gray-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

<main>

    @if (session('success'))
        <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-800">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{ $slot }}

</main>
    </div>
</body>
</html>
