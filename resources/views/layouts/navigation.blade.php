<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <x-application-logo class="h-10 w-auto fill-current text-[#2D3B22]" />
                </a>
            </div>

            {{-- Liens principaux --}}
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 hover:text-[#2D3B22] transition">Accueil</a>
                <a href="#a-propos" class="text-sm font-medium text-gray-700 hover:text-[#2D3B22] transition">À propos</a>
                <a href="{{ route('training-calendar.index') }}" class="text-sm font-medium text-gray-700 hover:text-[#2D3B22] transition">Formations</a>
                <a href="#services" class="text-sm font-medium text-gray-700 hover:text-[#2D3B22] transition">Services</a>
                <a href="#contact" class="text-sm font-medium text-gray-700 hover:text-[#2D3B22] transition">Contact</a>
            </div>

            {{-- Bouton Connexion / Dashboard --}}
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-[#2D3B22] text-white text-xs font-semibold px-5 py-2.5 rounded-full hover:bg-[#1e2817] transition shadow-sm">
                        Mon Tableau de bord
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-[#2D3B22] text-white text-xs font-semibold px-5 py-2.5 rounded-full hover:bg-[#1e2817] transition shadow-sm">
                        Se connecter
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>
