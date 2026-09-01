@extends('layouts.main')

@section('content')


<!-- Section Hero en pleine largeur/hauteur -->
<section class="relative w-full min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center m-0 p-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">

    <!-- Contenu centré sur le tableau -->
    <div class="text-center px-4 max-w-2xl mx-auto">

        <!-- Logo Textuel Noir & Or -->
        <div class="select-none mb-4">
            <h1 class="font-serif text-6xl md:text-7xl font-extralight tracking-tight text-neutral-900 leading-none">
                Oft
            </h1>
            <span class="block font-sans text-sm md:text-base font-medium tracking-[0.35em] uppercase text-[#C59B27] mt-1 drop-shadow-[0_1px_1px_rgba(0,0,0,0.15)]">
                ATELIER
            </span>
        </div>

        <p class="text-lg md:text-xl text-gray-800 font-medium mb-6">
            Ateliers divers et créations sur-mesure.
        </p>

        <!-- Boutons d'action -->
        <div class="flex flex-wrap justify-center gap-4">
            <a href="/formations" class="px-6 py-3 bg-[#82C341] text-white font-semibold rounded-lg shadow-md hover:bg-opacity-90 transition">
                Découvrir nos ateliers
            </a>
            <a href="/calendrier" class="px-6 py-3 bg-white text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-50 transition border border-gray-200">
                Voir le calendrier
            </a>
        </div>

    </div>
</section>

<!-- SECTION À PROPOS -->
<section id="a-propos" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center">
        <div class="md:col-span-5">
            <div class="rounded-3xl overflow-hidden shadow-md bg-gray-200 aspect-[4/3] md:aspect-[1/1] relative">
                <img src="{{ asset('images/a-propos.jpg') }}" alt="Machine à coudre de l'atelier" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="md:col-span-5 space-y-6">
            <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
                À propos de l'atelier
            </h2>
            <div class="space-y-4 text-gray-700 text-base md:text-lg leading-relaxed">
                <p>Depuis 2010, notre atelier de couture accompagne les passionnés dans la découverte et la maîtrise de l'art de la couture.</p>
                <p>Dans une ambiance chaleureuse et conviviale, nous vous proposons des formations, des ateliers créatifs et des confections sur mesure adaptées à vos envies.</p>
            </div>
            <div>
                <a href="#services" class="inline-flex items-center gap-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white px-6 py-3 rounded-full text-sm font-medium transition">
                    <span>En savoir plus</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

        <div class="hidden md:flex md:col-span-2 justify-center items-center opacity-60">
            <svg class="w-28 h-48" viewBox="0 0 100 180" fill="none" stroke="#2D3B22" stroke-width="1.5">
                <path d="M50 20 C40 20 35 35 35 50 C35 70 42 85 40 110 C38 125 30 135 30 135 L70 135 C70 135 62 125 60 110 C58 85 65 70 65 50 C65 35 60 20 50 20 Z" />
                <line x1="50" y1="135" x2="50" y2="175" />
                <line x1="35" y1="175" x2="65" y2="175" />
            </svg>
        </div>
    </div>
</section>

<!-- SECTION FORMATIONS & ATELIERS -->
<section id="services" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24">
    <div class="text-center mb-12">
        <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
            Découvrez nos formations et ateliers
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
        <!-- Carte 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                <div class="p-6 border-t-4 border-emerald-500">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold text-white bg-emerald-500 inline-block mb-3">
                        Initiation
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Cours & Ateliers Débutants
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Découvrez les bases de la couture, la prise en main de votre machine et vos premiers projets guidés.
                    </p>
                </div>
                <div class="p-6 bg-stone-50 border-t border-gray-100 mt-auto">
                    <a href="{{ route('trainings.index') }}"
                       class="block text-center w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition text-sm">
                        Voir les formations
                    </a>
                </div>
            </div>
        <!-- Carte 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                <div class="p-6 border-t-4 border-blue-500">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold text-white bg-blue-500 inline-block mb-3">
                        Perfectionnement
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Stages & Projets Avancés
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Confectionnez des pièces complexes : patrons, vêtements sur-mesure et techniques de finition.
                    </p>
                </div>
                <div class="p-6 bg-stone-50 border-t border-gray-100 mt-auto">
                    <a href="{{ route('trainings.index') }}"
                       class="block text-center w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition text-sm">
                        Voir les formations
                    </a>
                </div>
            </div>

        <!-- Carte 3 -->
        <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
            <div class="h-56 relative bg-gray-200">
                <img src="{{ asset('images/confections.jpg') }}" alt="Confections" class="w-full h-full object-cover">
                <div class="absolute -bottom-6 left-6 w-12 h-12 rounded-full bg-[#2D3B22] text-white flex items-center justify-center shadow">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div class="p-6 pt-10 flex-1 flex flex-col justify-between space-y-4">
                <div>
                    <h3 class="font-serif text-2xl text-[#2D3B22] font-semibold mb-3">Confections</h3>
                    <p class="text-sm md:text-base text-gray-700 leading-relaxed">Des créations uniques et sur mesure, pensées pour vous.</p>
                </div>
<a href="{{ Route::has('gallery.index') ? route('gallery.index') : '#' }}"
                       class="block text-center w-full py-2.5 px-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl transition text-sm">
                        Explorer la galerie
                    </a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION TÉMOIGNAGES -->
<section id="temoignages" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24">
    <div class="text-center mb-12 space-y-3">
        <span class="text-xs uppercase tracking-widest text-[#B58D56] font-semibold">Témoignages</span>
        <h2 class="font-serif text-3xl md:text-5xl text-[#2D3B22] font-normal italic">
            Elles ont poussé <span class="not-italic">la porte</span>
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @if(isset($testimonials) && count($testimonials) > 0)
            @foreach($testimonials as $testimonial)
                <div class="bg-[#F2EFE9] rounded-2xl p-8 shadow-sm flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex text-[#B58D56] gap-1">
                            ★ ★ ★ ★ ★
                        </div>
                        <p class="text-sm md:text-base text-gray-800 leading-relaxed">« {{ $testimonial->contenu }} »</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset($testimonial->avatar) }}" alt="{{ $testimonial->nom }}" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-semibold text-sm text-gray-900">{{ $testimonial->nom }}</h4>
                            <p class="text-xs text-gray-600">{{ $testimonial->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

<!-- SECTION CONTACT -->
<section id="contact" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24">
    <div class="bg-[#F2EFE9] rounded-3xl p-8 md:p-12 shadow-sm relative overflow-hidden">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center relative z-10">
            <div class="md:col-span-5 space-y-6">
                <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">Contactez-nous</h2>
                <div class="space-y-4 text-sm md:text-base text-gray-800">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h32a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                        <span>+596 696 92 62 64</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>oftcreation@gmail.com</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed pt-2">N'hésitez pas à nous écrire, nous vous répondrons dans les meilleurs délais.</p>
            </div>

            <div class="md:col-span-7">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <input type="text" name="nom" placeholder="Nom" value="{{ old('nom') }}" class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>
                            @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <textarea name="message" rows="4" placeholder="Message" class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white px-6 py-3 rounded-xl text-sm font-medium transition shadow-sm">
                            <span>Envoyer le message</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
