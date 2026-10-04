@extends('layouts.main')

@section('content')

<section id="accueil" class="relative w-full min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-start m-0 p-0 px-8 md:px-16 lg:px-24" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <div class="flex flex-col items-center text-center max-w-xl my-auto">

        <!-- Slogan Haut (Terracotta) -->
        <span class="block font-sans text-xs md:text-sm font-normal tracking-[0.25em] uppercase text-[#D17B5D] mb-6">
            APPRENDRE • CRÉER • TRANSMETTRE
        </span>

        <!-- Titre Style Logo "Oft ATELIER" -->
        <div class="flex flex-col items-center mb-6">
            <!-- "Oft" avec la ligne traversante derrière le t -->
            <div class="relative inline-block leading-none">
                <h1 class="font-serif text-6xl sm:text-7xl md:text-8xl font-medium text-[#2D4030] relative z-10">
                    Oft
                </h1>
                <!-- Ligne horizontale derrière la lettre "t" -->
                <div class="absolute top-[48%] right-[-12px] w-12 h-[1.5px] bg-[#999999] z-0"></div>
            </div>

            <!-- "ATELIER" en majuscules espacées -->
            <span class="font-sans text-sm sm:text-base md:text-lg tracking-[0.35em] uppercase text-[#D17B5D] font-medium mt-2">
                ATELIER
            </span>
        </div>

        <!-- Trait Séparateur -->
        <div class="w-10 h-[1.5px] bg-[#D17B5D] mb-6"></div>

        <!-- Description -->
        <p class="text-base md:text-lg text-[#333333] font-normal leading-relaxed mb-8 max-w-lg">
            Formations en couture et ateliers créatifs pour tous les niveaux.<br />
            De la première couture à la maîtrise des savoir-faire.
        </p>

        <!-- Boutons d'action -->
        <div class="flex flex-wrap justify-center gap-4 w-full">
            <a href="{{ route('trainings.formations') }}" class="px-6 py-3.5 bg-[#2D4030] hover:bg-[#233326] text-white font-medium text-xs md:text-sm tracking-wider uppercase rounded-sm shadow-sm transition duration-200">
                DÉCOUVRIR LES FORMATIONS
            </a>
            <a href="{{ route('trainings.workshops') }}" class="px-6 py-3.5 bg-transparent text-[#2D4030] font-medium text-xs md:text-sm tracking-wider uppercase rounded-sm border border-[#2D4030] hover:bg-[#2D4030]/5 transition duration-200">
                VOIR LES ATELIERS
            </a>
        </div>
    </div>
</section>
<!-- SECTION À PROPOS -->

<section id="a-propos" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24 scroll-mt-20">

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

                <p>Chez Oft Atelier, la passion se tisse fil après fil. Mon parcours est atypique : après quinze années dédiées à l'agriculture, j'ai choisi de donner une nouvelle direction à ma vie professionnelle.

Une formation initiale en tissage a été la porte d'entrée vers ce qui est aujourd'hui mon métier et ma vocation : la couture.</p>

                <p>Ce qui a commencé comme une activité secondaire est devenu une véritable expertise...</p>

            </div>

            <div>

               <a href="{{ route('atelier.about') }}"  class="px-6 py-3.5 bg-[#2D4030] hover:bg-[#233326] text-white font-medium text-xs md:text-sm tracking-wider uppercase rounded-sm shadow-sm transition duration-200">En savoir plus &rarr;</a>

            </div>

        </div>



        <div class="hidden md:flex md:col-span-2 justify-center items-center opacity-60">


        </div>

    </div>

</section>




@php
    // Liste des images disponibles dans public/images/
    $randomImages = [
        'formation.jpg',
        'crochet.jpg',
        'couture.jpg',
        'tricot.jpg',
        'broderie.jpg',
        'confections.jpg'

    ];

    // Sélection de 2 images distinctes pour les cartes 1 et 2
    $randomKeys = array_rand($randomImages, 2);
    $imageFormation = $randomImages[$randomKeys[0]];
    $imageWorkshop = $randomImages[$randomKeys[1]];
@endphp

<!-- SECTION NOS OFFRES -->
<section id="offres" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24 scroll-mt-20">
    <div class="text-center mb-12 space-y-3">
        <span class="text-xs uppercase tracking-widest text-[#B58D56] font-semibold">Découverte</span>
        <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal">
            Nos Offres
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
        <!-- Carte 1 : Formations -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
            <div class="border-t-4 border-emerald-500">
                <div class="h-48 w-full bg-gray-100 overflow-hidden relative">
                    <img src="{{ asset('images/' . $imageFormation) }}"
                         alt="{{ $featuredFormation->title ?? 'Cours & Formations' }}"
                         class="w-full h-full object-cover">
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold text-white bg-emerald-500 shadow-sm">
                        Tous niveaux
                    </span>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        {{ $featuredFormation->title ?? 'Confections sur mesure' }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ $featuredFormation->description ?? 'Sauver un vêtement, créer du sur-mesure ou retoucher avec soin…' }}
                    </p>
                </div>
            </div>

            <div class="p-6 bg-stone-50 border-t border-gray-100 mt-auto space-y-2">
                @if(isset($featuredFormation))
                    <a href="{{ route('trainings.show', $featuredFormation->id) }}" class="block text-center w-full py-2 px-4 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-xl transition text-xs">
                        En savoir plus sur ce cours
                    </a>
                @endif
                <a href="{{ route('trainings.formations') }}" class="block text-center w-full py-2.5 px-4 bg-[#82C341] hover:bg-opacity-90 text-white font-semibold rounded-xl transition text-sm">
                    Voir toutes les formations
                </a>
            </div>
        </div>

        <!-- Carte 2 : Ateliers Créatifs -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
            <div class="border-t-4 border-blue-500">
                <div class="h-48 w-full bg-gray-100 overflow-hidden relative">
                    <img src="{{ asset('images/' . $imageWorkshop) }}"
                         alt="{{ $featuredWorkshop->title ?? 'Ateliers Créatifs' }}"
                         class="w-full h-full object-cover">
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold text-white bg-blue-500 shadow-sm">
                        Initiation
                    </span>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        {{ $featuredWorkshop->title ?? 'Ateliers loisir' }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ $featuredWorkshop->description ?? 'Confectionnez des pièces thématiques : tricot, crochet, teinture, broderie et tissage.' }}
                    </p>
                </div>
            </div>

            <div class="p-6 bg-stone-50 border-t border-gray-100 mt-auto space-y-2">
                @if(isset($featuredWorkshop))
                    <a href="{{ route('trainings.show', $featuredWorkshop->id) }}" class="block text-center w-full py-2 px-4 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-xl transition text-xs">
                        En savoir plus sur cet atelier
                    </a>
                @endif
                <a href="{{ route('trainings.workshops') }}" class="block text-center w-full py-2.5 px-4 bg-[#82C341] hover:bg-opacity-90 text-white font-semibold rounded-xl transition text-sm">
                    Voir tous les ateliers
                </a>
            </div>
        </div>

       <!-- Carte 3 : Galerie des confections -->
@php
    $galeriePath = public_path('images/galerie');
    $imageFiles = \Illuminate\Support\Facades\File::exists($galeriePath)
        ? \Illuminate\Support\Facades\File::files($galeriePath)
        : [];

    $validImages = array_filter($imageFiles, function ($file) {
        return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif']);
    });

    if (!empty($validImages)) {
        shuffle($validImages);
        $randomGalleryImages = array_slice($validImages, 0, 1);
    } else {
        $randomGalleryImages = [];
    }
@endphp

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
            <div class="border-t-4 border-purple-500">
                <div class="h-48 w-full bg-gray-100 overflow-hidden relative">
                    @forelse($randomGalleryImages as $image)
                        <img src="{{ asset('images/galerie/' . $image->getFilename()) }}"
                             alt="Galerie confection"
                             class="w-full h-full object-cover">
                    @empty
                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                            Aucune image disponible
                        </div>
                    @endforelse
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold text-white bg-purple-500 shadow-sm">
                        Créations
                    </span>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Galerie de l'Atelier
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Découvrez nos créations uniques et l'ensemble des réalisations confectionnées au sein de nos ateliers.
                    </p>
                </div>
            </div>

            <div class="p-6 bg-stone-50 border-t border-gray-100 mt-auto space-y-2">
                <a href="{{ route('gallery.index') }}" class="block text-center w-full py-2.5 px-4 bg-[#82C341] hover:bg-opacity-90 text-white font-semibold rounded-xl transition text-sm">
                    Afficher la galerie
                </a>
            </div>
        </div>

    </div>
</section>
<!-- SECTION TÉMOIGNAGES -->
<section id="temoignages" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24 scroll-mt-20">
    <div class="text-center mb-12 space-y-3">
        <span class="text-xs uppercase tracking-widest text-[#B58D56] font-semibold">Témoignages</span>
        <h2 class="font-serif text-3xl md:text-5xl text-[#2D3B22] font-normal italic">
            Ce qu'ils pensent de nous
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($testimonials as $testimonial)
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <!-- Étoiles de notation -->
                <div class="flex text-amber-400 mb-3 text-lg">
                    @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                        ★
                    @endfor
                </div>
                <!-- Contenu -->
                <p class="text-gray-600 italic mb-4">"{{ $testimonial->content }}"</p>
            </div>
            <div>
                <p class="font-semibold text-gray-800">{{ $testimonial->author }}</p>
                @if($testimonial->role)
                    <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                @endif
            </div>
        </div>
    @empty
        <p class="col-span-full text-center text-gray-500">Aucun témoignage pour le moment.</p>
    @endforelse
</div>
</section>

<!-- SECTION CONTACT -->
<section id="contact" class="max-w-7xl mx-auto px-6 md:px-12 py-16 md:py-24 scroll-mt-20">
    <div class="bg-[#F2EFE9] rounded-3xl p-8 md:p-12 shadow-sm relative overflow-hidden">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start relative z-10">
            <!-- Infos de contact à gauche -->
            <div class="md:col-span-4 space-y-6">
                <div>
                    <span class="text-xs uppercase tracking-widest text-[#B58D56] font-semibold">Échangeons</span>
                    <h2 class="font-serif text-3xl md:text-4xl text-[#2D3B22] font-normal mt-1">Contactez-nous</h2>
                </div>

                <div class="space-y-4 text-sm md:text-base text-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#2D3B22] shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h32a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-500 font-medium">Téléphone</span>
                            <span class="font-medium">+596 696 92 62 64</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#2D3B22] shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-500 font-medium">Email</span>
                            <span class="font-medium">oftcreation@gmail.com</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#2D3B22] shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-500 font-medium">Horaires d'ouverture</span>
                            <span class="font-medium">Mardi - Vendredi : 9h00 - 16h00</span><br>
                            <span class="font-medium">Samedi : 8h00 - 12h00</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white/60 rounded-2xl border border-stone-200/50 text-xs text-gray-600 leading-relaxed">
                    Remplissez ce formulaire et nous vous recontacterons sous 48h.
                </div>
            </div>

            <!-- Formulaire de contact enrichi à droite -->
            <div class="md:col-span-8 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-stone-200/60">
                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Ligne 1 : Nom & Prénom -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                            <input type="text" name="nom" placeholder="Votre nom" value="{{ old('nom') }}" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>
                            @error('nom') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Prénom</label>
                            <input type="text" name="prenom" placeholder="Votre prénom" value="{{ old('prenom') }}" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]">
                            @error('prenom') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Ligne 2 : Email & Téléphone -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Téléphone</label>
                            <input type="tel" name="telephone" placeholder="06 96 XX XX XX" value="{{ old('telephone') }}" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]">
                            @error('telephone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Ligne 3 : Objet & Niveau / Type de projet -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Sujet de la demande <span class="text-red-500">*</span></label>
                            <select name="sujet" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>
                                <option value="" disabled {{ old('sujet') ? '' : 'selected' }}>Sélectionnez un sujet</option>
                                <option value="Information cours" {{ old('sujet') == 'Information cours' ? 'selected' : '' }}>Renseignement sur un cours / formation</option>
                                <option value="Inscription atelier" {{ old('sujet') == 'Inscription atelier' ? 'selected' : '' }}>Inscription à un atelier créatif</option>
                                <option value="Creation sur mesure" {{ old('sujet') == 'Creation sur mesure' ? 'selected' : '' }}>Commande / Confection sur-mesure</option>
                                <option value="Privatisation" {{ old('sujet') == 'Privatisation' ? 'selected' : '' }}>Commité d'entreprise / Atelier groupe</option>
                                <option value="Autre" {{ old('sujet') == 'Autre' ? 'selected' : '' }}>Autre demande</option>
                            </select>
                            @error('sujet') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Votre niveau en couture</label>
                            <select name="niveau" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]">
                                <option value="" selected>Niveau</option>
                                <option value="Debutant" {{ old('niveau') == 'Debutant' ? 'selected' : '' }}>Débutant</option>
                                <option value="Intermediaire" {{ old('niveau') == 'Intermediaire' ? 'selected' : '' }}>Intermédiaire </option>
                                <option value="Avance" {{ old('niveau') == 'Avance' ? 'selected' : '' }}>Avancé</option>
                            </select>
                            @error('niveau') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>



                    <!-- Ligne 5 : Message -->
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Message  <span class="text-red-500">*</span></label>
                        <textarea name="message" rows="4" placeholder="Décrivez votre projet, vos disponibilités ou vos questions..." class="w-full px-4 py-3 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]" required>{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Ligne 6 : Consentement & Bouton -->
                    <div class="pt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <label class="flex items-start gap-2 cursor-pointer text-xs text-gray-600">
                            <input type="checkbox" name="rgpd" required class="mt-0.5 rounded border-gray-300 text-[#2D3B22] focus:ring-[#2D3B22]">
                            <span>J'accepte que mes données soient utilisées pour traiter ma demande.</span>
                        </label>

                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white px-8 py-3 rounded-xl text-sm font-medium transition shadow-sm whitespace-nowrap">
                            <span>Envoyer le message</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<div class="bg-amber-50 rounded-2xl p-8 border border-amber-200 max-w-3xl mx-auto my-12 text-center">
    <h3 class="text-2xl font-bold text-gray-900">Newsletter</h3>


    @if(session('newsletter_success'))
        <div class="mt-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg text-sm font-medium">
            {{ session('newsletter_success') }}
        </div>
    @else
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-6 flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
            @csrf
            <div class="flex-1">
                <input
                    type="email"
                    name="email"
                    placeholder="Votre adresse e-mail"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                >
                @error('email')
                    <p class="text-red-500 text-xs text-left mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button
                type="submit"
                class="px-6 py-3 bg-amber-600 text-white font-semibold rounded-xl shadow hover:bg-amber-700 transition text-sm whitespace-nowrap"
            >
                S'inscrire
            </button>
        </form>
    @endif
</div>
<!-- MODAL POP-UP ÉVÉNEMENT -->
@if(isset($annonce) && $annonce)
    <div x-data="{ open: false }"
         x-init="if (!sessionStorage.getItem('event_popup_seen')) { open = true; }"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 transition-opacity">

        <div @click.away="open = false; sessionStorage.setItem('event_popup_seen', 'true')"
             class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl border border-stone-200">

            <!-- Bouton Fermer (Croix) -->
            <button @click="open = false; sessionStorage.setItem('event_popup_seen', 'true')"
                    class="absolute right-4 top-4 text-gray-400 hover:text-gray-700 text-2xl font-bold transition">
                &times;
            </button>

            <!-- Image de l'événement -->
    @if($annonce->image)
    <div class="mb-4 h-48 w-full overflow-hidden rounded-xl bg-gray-100">
        <img src="{{ asset('storage/' . $annonce->image) }}"
             alt="{{ $annonce->title }}"
             class="h-full w-full object-cover"
             onerror="this.onerror=null; this.src='{{ route('image.display', ['path' => $annonce->image]) }}';">
    </div>
@endif

            <!-- Titre & Contenu -->
            <h3 class="text-2xl font-serif font-bold text-[#2D3B22] mb-2">
                {{ $annonce->title }}
            </h3>

            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                {{ $annonce->description }}
            </p>

            @if($annonce->event_date)
                <p class="text-xs font-semibold text-[#D17B5D] uppercase tracking-wider mb-6">
                    📅 Date : {{ \Carbon\Carbon::parse($annonce->event_date)->format('d/m/Y') }}
                </p>
            @endif

            <!-- Bouton de fermeture -->
            <button @click="open = false; sessionStorage.setItem('event_popup_seen', 'true')"
                    class="w-full rounded-xl bg-[#2D4030] py-3 text-white font-medium hover:bg-[#233326] transition shadow-sm text-sm uppercase tracking-wider">
                Fermer
            </button>
        </div>
    </div>
@endif
@endsection
