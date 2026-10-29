<nav
    id="main-nav"
    x-data="{ open: false, scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{
        'bg-white/95 backdrop-blur-md shadow-sm border-gray-200/80': scrolled,
        'bg-transparent border-transparent': !scrolled
    }"
    class="fixed top-0 left-0 right-0 z-50 h-20
           transition-all duration-300 border-b"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
                h-full flex items-center justify-between">

        {{-- Logo --}}
        <a
            href="{{ route('home') }}"
            class="flex items-center gap-2"
            aria-label="Ôft Atelier, accueil"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt=""
                width="120"
                height="40"
                class="h-10 w-auto"
            >
        </a>

        {{-- Navigation desktop --}}
        <div class="hidden md:flex items-center gap-6 font-medium">
            <a
                href="{{ url('/#accueil') }}"
                class="text-gray-800 hover:text-[#2D4030]
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                Accueil
            </a>

            <a
                href="{{ url('/#a-propos') }}"
                class="text-gray-800 hover:text-[#2D4030]
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                À propos
            </a>

            <a
                href="{{ url('/#offres') }}"
                class="text-gray-800 hover:text-[#2D4030]
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                Nos Offres
            </a>

            <a
                href="{{ route('gallery.index') }}"
                class="text-gray-800 hover:text-[#2D4030]
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                Galerie
            </a>

            <a
                href="{{ url('/#temoignages') }}"
                class="text-gray-800 hover:text-[#2D4030]
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                Témoignages
            </a>

            <a
                href="{{ url('/#contact') }}"
                class="text-gray-800 hover:text-[#2D4030]
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                Contact
            </a>
        </div>

        {{-- Actions desktop --}}
        <div class="hidden md:flex items-center gap-4">
            @auth
                @if(auth()->user()->role === 'admin' || auth()->user()->is_admin)
                    <a
                        href="{{ url('/admin') }}"
                        class="px-4 py-2 text-xs font-bold text-white
                               bg-[#2D4030] rounded-full
                               hover:bg-[#1A2820] transition
                               focus-visible:outline-none
                               focus-visible:ring-2
                               focus-visible:ring-[#2D4030]
                               focus-visible:ring-offset-2"
                    >
                        MON TABLEAU DE BORD
                    </a>
                @else
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-2 text-xs font-bold text-white
                               bg-[#2D4030] rounded-full
                               hover:bg-[#1A2820] transition
                               focus-visible:outline-none
                               focus-visible:ring-2
                               focus-visible:ring-[#2D4030]
                               focus-visible:ring-offset-2"
                    >
                        MON TABLEAU DE BORD
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-xs font-bold text-red-700
                               hover:text-red-900 transition
                               focus-visible:outline-none
                               focus-visible:ring-2
                               focus-visible:ring-red-700
                               focus-visible:ring-offset-2 rounded"
                    >
                        DÉCONNEXION
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="text-xs font-bold text-[#2D4030]
                           hover:underline
                           focus-visible:outline-none
                           focus-visible:ring-2
                           focus-visible:ring-[#2D4030]
                           focus-visible:ring-offset-2 rounded"
                >
                    CONNEXION
                </a>
            @endauth
        </div>

        {{-- Bouton du menu mobile --}}
        <div class="flex md:hidden items-center">
            <button
                @click="open = !open"
                type="button"
                :aria-label="open
                    ? 'Fermer le menu principal'
                    : 'Ouvrir le menu principal'"
                :aria-expanded="open.toString()"
                aria-controls="menu-mobile"
                class="text-gray-800 hover:text-[#2D4030] p-2
                       focus-visible:outline-none
                       focus-visible:ring-2
                       focus-visible:ring-[#2D4030]
                       focus-visible:ring-offset-2 rounded"
            >
                <svg
                    class="h-7 w-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path
                        x-show="!open"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />

                    <path
                        x-show="open"
                        x-cloak
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div
        id="menu-mobile"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-white shadow-lg border-b border-gray-200
               px-6 pt-4 pb-6 space-y-4"
    >
        <a
            href="{{ url('/#accueil') }}"
            @click="open = false"
            class="block font-medium text-gray-800
                   hover:text-[#2D4030] py-1
                   focus-visible:outline-none
                   focus-visible:ring-2
                   focus-visible:ring-[#2D4030] rounded"
        >
            Accueil
        </a>

        <a
            href="{{ url('/#a-propos') }}"
            @click="open = false"
            class="block font-medium text-gray-800
                   hover:text-[#2D4030] py-1
                   focus-visible:outline-none
                   focus-visible:ring-2
                   focus-visible:ring-[#2D4030] rounded"
        >
            À propos
        </a>

        <a
            href="{{ url('/#offres') }}"
            @click="open = false"
            class="block font-medium text-gray-800
                   hover:text-[#2D4030] py-1
                   focus-visible:outline-none
                   focus-visible:ring-2
                   focus-visible:ring-[#2D4030] rounded"
        >
            Nos Offres
        </a>

        <a
            href="{{ route('gallery.index') }}"
            @click="open = false"
            class="block font-medium text-gray-800
                   hover:text-[#2D4030] py-1
                   focus-visible:outline-none
                   focus-visible:ring-2
                   focus-visible:ring-[#2D4030] rounded"
        >
            Galerie
        </a>

        <a
            href="{{ url('/#temoignages') }}"
            @click="open = false"
            class="block font-medium text-gray-800
                   hover:text-[#2D4030] py-1
                   focus-visible:outline-none
                   focus-visible:ring-2
                   focus-visible:ring-[#2D4030] rounded"
        >
            Témoignages
        </a>

        <a
            href="{{ url('/#contact') }}"
            @click="open = false"
            class="block font-medium text-gray-800
                   hover:text-[#2D4030] py-1
                   focus-visible:outline-none
                   focus-visible:ring-2
                   focus-visible:ring-[#2D4030] rounded"
        >
            Contact
        </a>

        <div class="pt-4 border-t border-gray-200 flex flex-col gap-3">
            @auth
                @if(auth()->user()->role === 'admin' || auth()->user()->is_admin)
                    <a
                        href="{{ url('/admin') }}"
                        class="px-4 py-3 text-xs font-bold text-white
                               bg-[#2D4030] rounded-full
                               hover:bg-[#1A2820] transition
                               text-center
                               focus-visible:outline-none
                               focus-visible:ring-2
                               focus-visible:ring-[#2D4030]
                               focus-visible:ring-offset-2"
                    >
                        MON TABLEAU DE BORD
                    </a>
                @else
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-3 text-xs font-bold text-white
                               bg-[#2D4030] rounded-full
                               hover:bg-[#1A2820] transition
                               text-center
                               focus-visible:outline-none
                               focus-visible:ring-2
                               focus-visible:ring-[#2D4030]
                               focus-visible:ring-offset-2"
                    >
                        MON TABLEAU DE BORD
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full text-left text-xs font-bold
                               text-red-700 hover:text-red-900 py-2
                               focus-visible:outline-none
                               focus-visible:ring-2
                               focus-visible:ring-red-700 rounded"
                    >
                        DÉCONNEXION
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="block text-xs font-bold text-[#2D4030]
                           hover:underline py-2
                           focus-visible:outline-none
                           focus-visible:ring-2
                           focus-visible:ring-[#2D4030] rounded"
                >
                    CONNEXION
                </a>
            @endauth
        </div>
    </div>
</nav>
