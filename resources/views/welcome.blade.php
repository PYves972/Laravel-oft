@extends('layouts.main')

@section('content')

<!-- HERO SECTION PROPRE -->
<section class="relative h-[calc(100vh-80px)] min-h-[500px] flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">

        <div class="text-center max-w-xl mx-auto px-4 -mt-16 sm:-mt-20">
            <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-[#2D3B22] font-bold tracking-tight mb-3">
                Ô fil du temps
            </h1>

            <div class="w-12 h-0.5 bg-[#2D3B22]/30 mx-auto mb-6"></div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('training-calendar.index') }}" class="w-full sm:w-auto bg-[#2D3B22] hover:bg-[#1e2817] text-white text-xs font-semibold px-6 py-3 rounded-full transition shadow-md">
                    Découvrir nos formations
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-900 text-xs font-semibold px-6 py-3 rounded-full transition shadow-md border border-gray-200">
                        Mon Tableau de bord
                    </a>
                @else
                    <a href="#a-propos" class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-900 text-xs font-semibold px-6 py-3 rounded-full transition shadow-md border border-gray-200">
                        En savoir plus
                    </a>
                @endauth
            </div>
        </div>
    </section>
<!-- SECTION À PROPOS -->
<section id="a-propos" class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center">

        <!-- Image de gauche -->
        <div class="md:col-span-5">
            <div class="rounded-3xl overflow-hidden shadow-md bg-gray-200 aspect-[4/3] md:aspect-[1/1] relative">
                <img src="{{ asset('images/a-propos.jpg') }}"
                     alt="Machine à coudre de l'atelier"
                     class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Contenu texte -->
        <div class="md:col-span-5 space-y-6">
            <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
                À propos de l'atelier
            </h2>

            <div class="space-y-4 text-gray-700 text-sm md:text-base leading-relaxed">
                <p>
                    Depuis 2010, notre atelier de couture accompagne les passionnés dans la découverte et la maîtrise de l'art de la couture.
                </p>
                <p>
                    Dans une ambiance chaleureuse et conviviale, nous vous proposons des formations, des ateliers créatifs et des confections sur mesure adaptées à vos envies.
                </p>
            </div>

            <div>
                <a href="#services" class="inline-flex items-center gap-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white px-6 py-3 rounded-full text-sm font-medium transition">
                    <span>En savoir plus</span>
                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Illustration -->
        <div class="hidden md:flex md:col-span-2 justify-center items-center opacity-60">
            <svg style="width: 120px; height: 200px;" viewBox="0 0 100 180" fill="none" stroke="#2D3B22" stroke-width="1.5">
                <path d="M50 20 C40 20 35 35 35 50 C35 70 42 85 40 110 C38 125 30 135 30 135 L70 135 C70 135 62 125 60 110 C58 85 65 70 65 50 C65 35 60 20 50 20 Z" />
                <line x1="50" y1="135" x2="50" y2="175" />
                <line x1="35" y1="175" x2="65" y2="175" />
                <path d="M65 120 C75 110 85 115 80 130 C75 145 65 135 65 135" stroke-dasharray="2 2" />
            </svg>
        </div>

    </div>
</section>

<!-- SECTION FORMATIONS & ATELIERS -->
<section id="services" class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20">

    <div class="text-center mb-12">
        <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
            Découvrez nos formations et ateliers
        </h2>
    </div>

    <div class="relative flex items-center justify-between gap-4">

        <button class="hidden lg:flex w-10 h-10 rounded-full bg-[#2D3B22] text-white items-center justify-center shadow hover:bg-[#1e2817] transition flex-shrink-0">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">

            <!-- Carte 1 -->
            <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="h-48 relative bg-gray-200">
                    <img src="{{ asset('images/formation.jpg') }}" alt="Formations" class="w-full h-full object-cover">
                    <div class="absolute -bottom-5 left-6 w-10 h-10 rounded-full bg-[#2D3B22] text-white flex items-center justify-center shadow">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                </div>
                <div class="p-6 pt-8 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl text-[#2D3B22] font-semibold mb-2">Formations</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-4">
                            Apprenez les bases ou perfectionnez vos techniques avec nos formations complètes.
                        </p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-medium text-gray-800 hover:text-[#2D3B22] transition">
                        <span>En savoir plus</span>
                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Carte 2 -->
            <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="h-48 relative bg-gray-200">
                    <img src="{{ asset('images/atelier.jpg') }}" alt="Ateliers" class="w-full h-full object-cover">
                    <div class="absolute -bottom-5 left-6 w-10 h-10 rounded-full bg-[#2D3B22] text-white flex items-center justify-center shadow">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="p-6 pt-8 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl text-[#2D3B22] font-semibold mb-2">Ateliers</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-4">
                            Participez à nos ateliers créatifs et réalisez vos projets dans une ambiance conviviale.
                        </p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-medium text-gray-800 hover:text-[#2D3B22] transition">
                        <span>En savoir plus</span>
                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Carte 3 -->
            <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="h-48 relative bg-gray-200">
                    <img src="{{ asset('images/confections.jpg') }}" alt="Confections" class="w-full h-full object-cover">
                    <div class="absolute -bottom-5 left-6 w-10 h-10 rounded-full bg-[#2D3B22] text-white flex items-center justify-center shadow">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <div class="p-6 pt-8 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl text-[#2D3B22] font-semibold mb-2">Confections</h3>
                        <p class="text-xs text-gray-600 leading-relaxed mb-4">
                            Des créations uniques et sur mesure, pensées pour vous.
                        </p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-1 text-xs font-medium text-gray-800 hover:text-[#2D3B22] transition">
                        <span>En savoir plus</span>
                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

        </div>

        <button class="hidden lg:flex w-10 h-10 rounded-full bg-[#2D3B22] text-white items-center justify-center shadow hover:bg-[#1e2817] transition flex-shrink-0">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

    </div>

</section>

<!-- SECTION TÉMOIGNAGES -->
<section class="max-w-7xl mx-auto px-6 md:px-12 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @if(isset($testimonials) && count($testimonials) > 0)
            @foreach($testimonials as $testimonial)
                <div class="bg-[#F2EFE9] rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-6">
                    <div class="flex items-start gap-3">
                        <span class="text-[#2D3B22] text-3xl font-serif leading-none font-bold">“</span>
                        <p class="text-xs text-gray-700 leading-relaxed pt-1">
                            {{ $testimonial->contenu }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset($testimonial->avatar) }}" alt="{{ $testimonial->nom }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="font-semibold text-xs text-gray-900">{{ $testimonial->nom }}</h4>
                            <p class="text-[11px] text-gray-500">{{ $testimonial->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

<!-- SECTION CONTACT -->
<section id="contact" class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20">
    <div class="bg-[#F2EFE9] rounded-3xl p-8 md:p-12 shadow-sm relative overflow-hidden">

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center relative z-10">

            <div class="md:col-span-5 space-y-6">
                <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
                    Contactez-nous
                </h2>

                <div class="space-y-4 text-xs md:text-sm text-gray-700">
                    <div class="flex items-center gap-3">
                        <svg style="width: 18px; height: 18px;" class="text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h32a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                        <span>+33 456 53000</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg style="width: 18px; height: 18px;" class="text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>email@figma.com</span>
                    </div>
                </div>

                <p class="text-xs text-gray-600 leading-relaxed pt-2">
                    N'hésitez pas à nous écrire, nous vous répondrons dans les meilleurs délais.
                </p>
            </div>

            <div class="md:col-span-7">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <input type="text" name="nom" placeholder="Nom" value="{{ old('nom') }}" class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2D3B22]" required>
                            @error('nom') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2D3B22]" required>
                            @error('email') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <textarea name="message" rows="4" placeholder="Message" class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2D3B22]" required>{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white px-6 py-3 rounded-xl text-xs font-medium transition shadow-sm">
                            <span>Envoyer le message</span>
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>
@endsection
