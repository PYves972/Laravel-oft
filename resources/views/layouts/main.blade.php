<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Atelier Couture') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9F8F3] text-gray-800 font-sans antialiased">

    <!-- HEADER / NAVIGATION STICKY -->
  <!-- HEADER EN OVERLAY TRANSPARENT -->
<header class="fixed top-0 left-0 w-full z-50 bg-white/20 backdrop-blur-md transition">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
<!-- Remplacez le texte "Atelier Couture" par ceci : -->
<a href="{{ url('/') }}" class="flex items-center">
    <x-application-logo class="w-auto h-8 fill-current text-gray-800" />
</a>

        <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
            <a href="{{ url('/') }}" class="text-[#2D3B22] font-semibold border-b-2 border-[#2D3B22] pb-1">Accueil</a>
            <a href="#a-propos" class="text-gray-800 hover:text-[#2D3B22] transition">À propos</a>
            <a href="#services" class="text-gray-800 hover:text-[#2D3B22] transition">Services</a>
            <a href="#portfolio" class="text-gray-800 hover:text-[#2D3B22] transition">Portfolio</a>
            <a href="#contact" class="text-gray-800 hover:text-[#2D3B22] transition">Contact</a>
        </nav>

        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 bg-[#2D3B22] text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-[#1e2817] transition shadow-md">
                        Mon Tableau de bord
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-[#2D3B22] text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-[#1e2817] transition shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Lien de connexion
                    </a>
                @endauth
            @endif
        </div>
    </div>
</header>

    <!-- CONTENU PRINCIPAL DE LA PAGE -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#233019] text-white pt-12 pb-6 px-6 md:px-12 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-8 pb-12 border-b border-white/10 text-sm">

            <div class="md:col-span-1 space-y-4">
                <img src="{{ asset('images/logo-white.png') }}" alt="Atelier Couture" class="h-10">
                <p class="text-gray-300 text-xs leading-relaxed">
                    L'art de la couture au service de votre créativité depuis 2010.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-base mb-4">Navigation</h4>
                <ul class="space-y-2 text-gray-300 text-xs">
                    <li><a href="#" class="hover:text-white transition">Accueil</a></li>
                    <li><a href="#a-propos" class="hover:text-white transition">À propos</a></li>
                    <li><a href="#services" class="hover:text-white transition">Services</a></li>
                    <li><a href="#contact" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-base mb-4">Nos services</h4>
                <ul class="space-y-2 text-gray-300 text-xs">
                    <li><a href="#" class="hover:text-white transition">Formations</a></li>
                    <li><a href="#" class="hover:text-white transition">Ateliers</a></li>
                    <li><a href="#" class="hover:text-white transition">Confections</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-base mb-4">Informations</h4>
                <ul class="space-y-2 text-gray-300 text-xs">
                    <li><a href="#" class="hover:text-white transition">Mentions légales</a></li>
                    <li><a href="#" class="hover:text-white transition">Politique de confidentialité</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-base mb-4">Contact</h4>
                <ul class="space-y-3 text-gray-300 text-xs">
                    <li>+33 456 53000</li>
                    <li>email@figma.com</li>
                </ul>
            </div>

        </div>

        <div class="max-w-7xl mx-auto text-center text-xs text-gray-400 pt-6">
            © 2024 Atelier Couture. Tous droits réservés.
        </div>
    </footer>

</body>
</html>
