@extends('layouts.main')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative max-w-7xl mx-auto px-6 md:px-12 py-8">

        <!-- Bloc Conteneur Arrondi -->
        <div class="relative rounded-3xl overflow-hidden shadow-xl min-h-[480px] md:min-h-[520px] flex items-center justify-center text-center p-8 bg-[#2D3B22]">

            <!-- Image de fond (S'affiche uniquement si elle existe dans public/images/hero-bg.jpg) -->
            <img src="{{ asset('images/hero-bg.jpg') }}"
                 alt="Atelier Couture"
                 class="absolute inset-0 w-full h-full object-cover opacity-60"
                 onerror="this.style.display='none'">

            <!-- Contenu Texte -->
            <div class="relative z-10 max-w-2xl mx-auto text-white space-y-6">

                <h1 class="font-serif text-3xl md:text-5xl font-normal leading-tight">
                    Créez, apprenez, réalisez vos idées avec <span class="italic font-light">passion</span>
                </h1>

                <!-- Séparateur décoratif -->
                <div class="flex items-center justify-center my-4">
                    <div class="h-[1px] w-12 bg-white/60"></div>
                    <div class="w-2 h-2 rotate-45 border border-white mx-2"></div>
                    <div class="h-[1px] w-12 bg-white/60"></div>
                </div>

                <p class="text-sm md:text-base font-light text-gray-100 max-w-xl mx-auto">
                    Atelier de couture – Formations, ateliers et confections pour tous les niveaux.
                </p>

                <!-- Call To Actions -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#formations" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#3c4e2e] hover:bg-[#1e2817] text-white px-6 py-3 rounded-full text-sm font-medium border border-white/20 transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span>Découvrir nos formations</span>
                    </a>

                    <a href="#portfolio" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/90 hover:bg-white text-gray-900 px-6 py-3 rounded-full text-sm font-medium transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Voir nos créations</span>
                    </a>
                </div>

            </div>
        </div>

    </section>
<!-- SECTION À PROPOS -->
<section id="a-propos" class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center">

        <!-- Image de gauche avec coins arrondis -->
        <div class="md:col-span-5">
            <div class="rounded-3xl overflow-hidden shadow-md bg-gray-200 aspect-[4/3] md:aspect-[1/1] relative">
                <img src="{{ asset('images/a-propos.jpg') }}"
                     alt="Machine à coudre de l'atelier"
                     class="w-full h-full object-cover"
                     onerror="this.src='https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=1000&auto=format&fit=crop'">
            </div>
        </div>

        <!-- Contenu texte au centre -->
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

        <!-- Illustration filaire mannequin (droite) -->
        <div class="hidden md:flex md:col-span-2 justify-center items-center opacity-60">
            <svg style="width: 120px; height: 200px;" viewBox="0 0 100 180" fill="none" stroke="#2D3B22" stroke-width="1.5">
                <!-- Illustration simplifiée mannequin/feuille -->
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

    <!-- Titre de section -->
    <div class="text-center mb-12">
        <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
            Découvrez nos formations et ateliers
        </h2>
    </div>

    <!-- Conteneur Carrousel / Cartes -->
    <div class="relative flex items-center justify-between gap-4">

        <!-- Flèche Gauche -->
        <button class="hidden lg:flex w-10 h-10 rounded-full bg-[#2D3B22] text-white items-center justify-center shadow hover:bg-[#1e2817] transition flex-shrink-0">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Grille des 3 cartes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">

            <!-- Carte 1 : Formations -->
            <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="h-48 relative bg-gray-200">
                    <img src="{{ asset('images/formation.jpg') }}" alt="Formations" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1528575910086-38fa5531833a?q=80&w=600&auto=format&fit=crop'">
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

            <!-- Carte 2 : Ateliers -->
            <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="h-48 relative bg-gray-200">
                    <img src="{{ asset('images/atelier.jpg') }}" alt="Ateliers" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=600&auto=format&fit=crop'">
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

            <!-- Carte 3 : Confections -->
            <div class="bg-[#F2EFE9] rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="h-48 relative bg-gray-200">
                    <img src="{{ asset('images/confections.jpg') }}" alt="Confections" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=600&auto=format&fit=crop'">
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

        <!-- Flèche Droite -->
        <button class="hidden lg:flex w-10 h-10 rounded-full bg-[#2D3B22] text-white items-center justify-center shadow hover:bg-[#1e2817] transition flex-shrink-0">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

    </div>

    <!-- Pagination Dots -->
    <div class="flex justify-center items-center gap-2 mt-8">
        <span class="w-2.5 h-2.5 rounded-full bg-[#2D3B22]"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-gray-300"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-gray-300"></span>
    </div>

</section>
<!-- SECTION TÉMOIGNAGES -->
<section class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20">

    <!-- Titre -->
    <div class="text-center mb-12">
        <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
            Nos clients parlent de nous
        </h2>
    </div>

    <!-- Grille des 3 témoignages -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Témoignage 1 -->
        <div class="bg-[#F2EFE9] rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-6">
            <div class="flex items-start gap-3">
                <span class="text-[#2D3B22] text-3xl font-serif leading-none font-bold">“</span>
                <p class="text-xs text-gray-700 leading-relaxed pt-1">
                    Une équipe à l'écoute, des cours de qualité et une ambiance au top !
                </p>
            </div>
            <div class="flex items-center gap-3">
                <img src="https://i.pravatar.cc/100?img=5" alt="Sophie L." class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h4 class="font-semibold text-xs text-gray-900">Sophie L.</h4>
                    <p class="text-[11px] text-gray-500">Élève en couture</p>
                </div>
            </div>
        </div>

        <!-- Témoignage 2 -->
        <div class="bg-[#F2EFE9] rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-6">
            <div class="flex items-start gap-3">
                <span class="text-[#2D3B22] text-3xl font-serif leading-none font-bold">“</span>
                <p class="text-xs text-gray-700 leading-relaxed pt-1">
                    Grâce à l'atelier, j'ai pu réaliser ma robe de mariée. Un rêve devenu réalité !
                </p>
            </div>
            <div class="flex items-center gap-3">
                <img src="https://i.pravatar.cc/100?img=9" alt="Julie M." class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h4 class="font-semibold text-xs text-gray-900">Julie M.</h4>
                    <p class="text-[11px] text-gray-500">Cliente</p>
                </div>
            </div>
        </div>

        <!-- Témoignage 3 -->
        <div class="bg-[#F2EFE9] rounded-2xl p-6 shadow-sm flex flex-col justify-between space-y-6">
            <div class="flex items-start gap-3">
                <span class="text-[#2D3B22] text-3xl font-serif leading-none font-bold">“</span>
                <p class="text-xs text-gray-700 leading-relaxed pt-1">
                    Des ateliers variés et inspirants. Je recommande vivement !
                </p>
            </div>
            <div class="flex items-center gap-3">
                <img src="https://i.pravatar.cc/100?img=16" alt="Claire D." class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h4 class="font-semibold text-xs text-gray-900">Claire D.</h4>
                    <p class="text-[11px] text-gray-500">Participante aux ateliers</p>
                </div>
            </div>
        </div>

    </div>

</section>
<!-- SECTION CONTACT -->
<section id="contact" class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20">
    <div class="bg-[#F2EFE9] rounded-3xl p-8 md:p-12 shadow-sm relative overflow-hidden">

        <!-- Message de confirmation si envoyé -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center relative z-10">

            <!-- Informations de contact (Gauche) -->
            <div class="md:col-span-5 space-y-6">
                <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
                    Contactez-nous
                </h2>

                <div class="space-y-4 text-xs md:text-sm text-gray-700">
                    <div class="flex items-center gap-3">
                        <svg style="width: 18px; height: 18px;" class="text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h32a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm12 0a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2V5z"></path></svg>
                        <span>+33 456 53000</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg style="width: 18px; height: 18px;" class="text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>email@figma.com</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg style="width: 18px; height: 18px;" class="text-[#2D3B22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"></path></svg>
                        <span>info@figma.com</span>
                    </div>
                </div>

                <p class="text-xs text-gray-600 leading-relaxed pt-2">
                    N'hésitez pas à nous écrire, nous vous répondrons dans les meilleurs délais.
                </p>
            </div>

            <!-- Formulaire de contact (Droite) -->
            <div class="md:col-span-7">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <input type="text"
                                   name="nom"
                                   placeholder="Nom"
                                   value="{{ old('nom') }}"
                                   class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2D3B22]"
                                   required>
                            @error('nom') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <input type="email"
                                   name="email"
                                   placeholder="Email"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2D3B22]"
                                   required>
                            @error('email') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <textarea name="message"
                                  rows="4"
                                  placeholder="Message"
                                  class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2D3B22]"
                                  required>{{ old('message') }}</textarea>
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

        <!-- Illustration végétale discrète en arrière-plan -->
        <div class="absolute -bottom-10 -right-10 opacity-15 pointer-events-none">
            <svg style="width: 200px; height: 200px;" viewBox="0 0 100 100" fill="none" stroke="#2D3B22" stroke-width="1">
                <path d="M50 90 Q60 50 80 10 M50 90 Q40 50 20 10 M50 90 Q50 40 50 10" />
            </svg>
        </div>

    </div>
</section>
@endsection
