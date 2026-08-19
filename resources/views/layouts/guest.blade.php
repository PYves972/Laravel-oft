<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
            rel="stylesheet"
        >

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="bg-cream">



    <div class="min-h-screen bg-cream flex flex-col items-center justify-center px-4 py-12">

            <div class="mb-10 text-center">
                <a href="/" class="inline-block">
                  <div class="mb-10 text-center">
    <a href="/">
        <x-application-logo />
    </a>
</div>
                </a>
            </div>

            <div class="w-full max-w-md">
                <div class="rounded-2xl border border-gold/20 bg-white p-8 shadow-[0_12px_40px_rgba(31,28,25,0.06)] sm:p-10">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
