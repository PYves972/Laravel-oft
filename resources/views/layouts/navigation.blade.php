<nav id="main-nav"
     x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="{ 'bg-white/95 backdrop-blur-md shadow-sm border-gray-200/80': scrolled, 'bg-transparent border-transparent': !scrolled }"
     class="fixed top-0 left-0 right-0 z-50 h-20 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo OFT" class="h-10 w-auto">
        </a>

        <!-- Liens Desktop (Masqués sur Mobile) -->
        <div class="hidden md:flex items-center gap-6 font-medium text-gray-700">
            <a href="#accueil" class="hover:text-[#2D3B22] transition">Accueil</a>
            <a href="#a-propos" class="hover:text-[#2D3B22] transition">À propos</a>
            <a href="#offres" class="hover:text-[#2D3B22] transition">Nos Offres</a>
            <a href="{{ route('gallery.index') }}" class="hover:text-[#2D3B22] transition">Galerie</a>
            <a href="#temoignages" class="hover:text-[#2D3B22] transition">Témoignages</a>
            <a href="#contact" class="hover:text-[#2D3B22] transition">Contact</a>
        </div>

        <!-- Boutons d'Action (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            @auth
                <a href="{{ url('/admin') }}" class="px-4 py-2 text-xs font-bold text-white bg-[#2D3B22] rounded-full hover:bg-[#1a2314] transition">
                    MON TABLEAU DE BORD
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">
                        DÉCONNEXION
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-xs font-bold text-[#2D3B22] hover:underline">CONNEXION</a>
            @endauth
        </div>

        <!-- Bouton Burger Mobile -->
        <div class="flex md:hidden items-center">
            <button @click="open = !open" type="button" class="text-gray-700 hover:text-[#2D3B22] focus:outline-none p-2">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Menu Déroulant Mobile -->
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-200 px-6 pt-4 pb-6 space-y-4">

        <a href="#accueil" @click="open = false" class="block font-medium text-gray-700 hover:text-[#2D3B22]">Accueil</a>
        <a href="#a-propos" @click="open = false" class="block font-medium text-gray-700 hover:text-[#2D3B22]">À propos</a>
        <a href="#offres" @click="open = false" class="block font-medium text-gray-700 hover:text-[#2D3B22]">Nos Offres</a>
        <a href="{{ route('gallery.index') }}" @click="open = false" class="block font-medium text-gray-700 hover:text-[#2D3B22]">Galerie</a>
        <a href="#temoignages" @click="open = false" class="block font-medium text-gray-700 hover:text-[#2D3B22]">Témoignages</a>
        <a href="#contact" @click="open = false" class="block font-medium text-gray-700 hover:text-[#2D3B22]">Contact</a>

        <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
            @auth
                <a href="{{ url('/admin') }}" class="w-full text-center py-2 text-xs font-bold text-white bg-[#2D3B22] rounded-full">
                    MON TABLEAU DE BORD
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full text-center">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-red-600">DÉCONNEXION</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="w-full text-center py-2 text-xs font-bold text-[#2D3B22] border border-[#2D3B22] rounded-full">
                    CONNEXION
                </a>
            @endauth
        </div>
    </div>
</nav>
