<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 h-20 bg-[#F9F8F3] border-b border-gray-200/60 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Oft Atelier" class="h-10 w-auto object-contain" />
                </a>
            </div>

            <!-- Liens de navigation (Galerie pointe vers la page dédiée) -->
            <div class="hidden md:flex space-x-6 items-center font-medium text-sm text-gray-800">
                <a href="{{ url('/') }}#accueil" class="hover:text-[#2D3B22] transition-colors">Accueil</a>
                <a href="{{ url('/') }}#a-propos" class="hover:text-[#2D3B22] transition-colors">À propos</a>
                <a href="{{ url('/') }}#offres" class="hover:text-[#2D3B22] transition-colors">Nos Offres</a>
                <a href="{{ route('gallery.index') }}" class="hover:text-[#2D3B22] transition-colors">Galerie</a>
                <a href="{{ url('/') }}#temoignages" class="hover:text-[#2D3B22] transition-colors">Témoignages</a>
                <a href="{{ url('/') }}#contact" class="hover:text-[#2D3B22] transition-colors">Contact</a>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white bg-[#2D3B22] hover:bg-[#1e2817] rounded-full transition-all shadow-sm">
                        Mon Tableau de bord
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold uppercase tracking-wider text-red-700 hover:text-red-900 border border-red-200 hover:border-red-400 rounded-full transition-all">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white bg-[#2D3B22] hover:bg-[#1e2817] rounded-full transition-all shadow-sm">
                        Connexion
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>
