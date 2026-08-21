<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Atelier Couture') }}</title>

    <!-- Fonts Google (Optionnel : vous pouvez ajuster la police si besoin) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- Scripts et Styles gérés par Vite / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9F8F3] text-gray-800 font-sans antialiased">

    <!-- HEADER / NAVIGATION -->
    <header class="w-full bg-[#F9F8F3] py-4 px-6 md:px-12 border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <!-- Remplacez le chemin par votre image de logo -->
                <img src="{{ asset('images/logo.png') }}" alt="Atelier Couture" class="h-12">
            </a>

            <!-- Navigation Principale -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="{{ url('/') }}" class="text-[#2D3B22] font-semibold border-b-2 border-[#2D3B22] pb-1">Accueil</a>
                <a href="#a-propos" class="text-gray-600 hover:text-[#2D3B22] transition">À propos</a>
                <a href="#services" class="text-gray-600 hover:text-[#2D3B22] transition">Services</a>
                <a href="#portfolio" class="text-gray-600 hover:text-[#2D3B22] transition">Portfolio</a>
                <a href="#contact" class="text-gray-600 hover:text-[#2D3B22] transition">Contact</a>
            </nav>

            <!-- Bouton Authentification (Lien avec Laravel Breeze) -->
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 bg-[#2D3B22] text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-[#1e2817] transition">
                            Mon Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-[#2D3B22] text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-[#1e2817] transition">
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

            <!-- Col 1 : Brand & Info -->
            <div class="md:col-span-1 space-y-4">
                <img src="{{ asset('images/logo-white.png') }}" alt="Atelier Couture" class="h-12">
                <p class="text-gray-300 text-xs leading-relaxed">
                    L'art de la couture au service de votre créativité depuis 2010.
                </p>
                <div class="flex gap-3 pt-2">
                    <a href="#" class="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center hover:bg-white/10 transition">f</a>
                    <a href="#" class="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center hover:bg-white/10 transition">ig</a>
                    <a href="#" class="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center hover:bg-white/10 transition">p</a>
                </div>
            </div>

            <!-- Col 2 : Navigation -->
            <div>
                <h4 class="font-semibold text-base mb-4">Navigation</h4>
                <ul class="space-y-2 text-gray-300 text-xs">
                    <li><a href="#" class="hover:text-white transition">Accueil</a></li>
                    <li><a href="#" class="hover:text-white transition">À propos</a></li>
                    <li><a href="#" class="hover:text-white transition">Services</a></li>
                    <li><a href="#" class="hover:text-white transition">Portfolio</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <!-- Col 3 : Services -->
            <div>
                <h4 class="font-semibold text-base mb-4">Nos services</h4>
                <ul class="space-y-2 text-gray-300 text-xs">
                    <li><a href="#" class="hover:text-white transition">Formations</a></li>
                    <li><a href="#" class="hover:text-white transition">Ateliers</a></li>
                    <li><a href="#" class="hover:text-white transition">Confections</a></li>
                    <li><a href="#" class="hover:text-white transition">Retouches</a></li>
                    <li><a href="#" class="hover:text-white transition">Sur mesure</a></li>
                </ul>
            </div>

            <!-- Col 4 : Informations -->
            <div>
                <h4 class="font-semibold text-base mb-4">Informations</h4>
                <ul class="space-y-2 text-gray-300 text-xs">
                    <li><a href="#" class="hover:text-white transition">Mentions légales</a></li>
                    <li><a href="#" class="hover:text-white transition">Politique de confidentialité</a></li>
                    <li><a href="#" class="hover:text-white transition">Conditions générales</a></li>
                    <li><a href="#" class="hover:text-white transition">Paiement sécurisé</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                </ul>
            </div>

            <!-- Col 5 : Contact -->
            <div>
                <h4 class="font-semibold text-base mb-4">Contact</h4>
                <ul class="space-y-3 text-gray-300 text-xs">
                    <li>+33 456 53000</li>
                    <li>email@figma.com</li>
                    <li>123 Rue de la Couture<br>75000 Paris, France</li>
                </ul>
            </div>

        </div>

        <div class="max-w-7xl mx-auto text-center text-xs text-gray-400 pt-6">
            © 2024 Atelier Couture. Tous droits réservés.
        </div>
    </footer>

</body>
</html>
