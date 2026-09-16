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
                <a href="#temoignages" class="inline-flex items-center gap-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white px-6 py-3 rounded-full text-sm font-medium transition">
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
                    {{-- Vérification si l'enregistrement possède une image en base de données --}}
                    @if(!empty($featuredFormation?->image_path))
                        <img src="{{ asset('storage/' . $featuredFormation->image_path) }}" alt="{{ $featuredFormation->title ?? 'Cours & Formations' }}" class="w-full h-full object-cover">
                    @else
                        {{-- Image temporaire si aucune image n'est enregistrée en base de données --}}
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                            Aucune image disponible
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold text-white bg-emerald-500 shadow-sm">
                        Initiation
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
                    @if(!empty($featuredWorkshop?->image_path))
                        <img src="{{ asset('storage/' . $featuredWorkshop->image_path) }}" alt="{{ $featuredWorkshop->title ?? 'Ateliers Créatifs' }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                            Aucune image disponible
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold text-white bg-blue-500 shadow-sm">
                        Perfectionnement
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
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
            <div class="p-6 border-t-4 border-amber-400">
                <span class="px-3 py-1 rounded-full text-xs font-bold text-amber-950 bg-amber-400 inline-block mb-3">
                    Galerie
                </span>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Nos Confections</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Aperçu des pièces et créations confectionnées à la main au sein de notre atelier.
                </p>

                <div class="grid grid-cols-3 gap-2 my-4">
                    <img src="{{ asset('storage/gallery/couture.jpg') }}" alt="Confection 1" class="w-full h-20 object-cover rounded-lg shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=300&q=80'">
                    <img src="{{ asset('storage/gallery/tricot.jpg') }}" alt="Confection 2" class="w-full h-20 object-cover rounded-lg shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1584992236310-6edddc08acff?auto=format&fit=crop&w=300&q=80'">
                    <img src="{{ asset('storage/gallery/broderie.jpg') }}" alt="Confection 3" class="w-full h-20 object-cover rounded-lg shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?auto=format&fit=crop&w=300&q=80'">
                    <img src="{{ asset('storage/gallery/teinture.jpg') }}" alt="Confection 4" class="w-full h-20 object-cover rounded-lg shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=300&q=80'">
                    <img src="{{ asset('storage/gallery/tissage.jpg') }}" alt="Confection 5" class="w-full h-20 object-cover rounded-lg shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1528458876861-544fd1761a91?auto=format&fit=crop&w=300&q=80'">
                    <img src="{{ asset('storage/gallery/confection6.jpg') }}" alt="Confection 6" class="w-full h-20 object-cover rounded-lg shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1619252584172-a83a949b6efd?auto=format&fit=crop&w=300&q=80'">
                </div>
            </div>

            <div class="p-6 bg-stone-50 border-t border-gray-100 mt-auto">
                <a href="{{ route('gallery.index') }}" class="block text-center w-full py-2.5 px-4 bg-amber-400 hover:bg-amber-500 text-amber-950 font-bold rounded-xl transition text-sm">
                    Voir toute la galerie
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
            Elles ont poussé <span class="not-italic">la porte</span>
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
                            <span class="font-medium">Mar - Sam : 9h00 - 16h00</span>
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
                                <option value="Privatisation" {{ old('sujet') == 'Privatisation' ? 'selected' : '' }}>Privatisation d'événement / Atelier groupe</option>
                                <option value="Autre" {{ old('sujet') == 'Autre' ? 'selected' : '' }}>Autre demande</option>
                            </select>
                            @error('sujet') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-gray-700 mb-1">Votre niveau en couture</label>
                            <select name="niveau" class="w-full px-4 py-2.5 bg-[#F9F8F3] border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:border-[#2D3B22]">
                                <option value="" selected>Non renseigné</option>
                                <option value="Debutant" {{ old('niveau') == 'Debutant' ? 'selected' : '' }}>Débutant(e) complet</option>
                                <option value="Intermediaire" {{ old('niveau') == 'Intermediaire' ? 'selected' : '' }}>Intermédiaire (quelques bases)</option>
                                <option value="Avance" {{ old('niveau') == 'Avance' ? 'selected' : '' }}>Avancé(e) / Autonome</option>
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
    <h3 class="text-2xl font-bold text-gray-900">Restez informé des prochains événements</h3>


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
@endsection
