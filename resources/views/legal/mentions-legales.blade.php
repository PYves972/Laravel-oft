@extends('layouts.main')

@section('content')
<div class="pt-28 pb-16 bg-stone-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-serif text-[#2D3B22] font-bold">Mentions Légales</h1>
            <p class="mt-2 text-gray-600 text-sm">Informations réglementaires concernant le site Oft Atelier.</p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 space-y-6 text-gray-700 text-sm leading-relaxed">
            
            {{-- Éditeur du site --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Éditeur du site</h2>
                <p>Le présent site est édité par :</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li><strong>Nom de l'entreprise :</strong> Oft Atelier</li>
                    <li><strong>Statut juridique :</strong> [À compléter]</li>
                    <li><strong>Siège social :</strong> Quartier Ermitage Gonnier, Saint-Joseph</li>
                    <li><strong>SIREN / SIRET :</strong> 50865188200021</li>
                    <li><strong>Numéro de TVA :</strong> Non applicable</li>
                    <li><strong>E-mail :</strong> oftcreation@gmail.com</li>
                    <li><strong>Téléphone :</strong> +596 696 92 62 64</li>
                  
                </ul>
            </section>

            <hr class="border-stone-100">

            {{-- Hébergement --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Hébergement</h2>
                <p>Le site est hébergé par :</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li><strong>Hébergeur :</strong> [Nom de l'hébergeur]</li>
                    <li><strong>Adresse :</strong> [Adresse de l'hébergeur]</li>
                    <li><strong>Téléphone :</strong> [Facultatif]</li>
                    <li><strong>Site internet :</strong> [Site de l'hébergeur]</li>
                </ul>
            </section>

            <hr class="border-stone-100">

            {{-- Propriété intellectuelle --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Propriété intellectuelle</h2>
                <p>L'ensemble des éléments présents sur le site Oft Atelier, notamment les textes, photographies, illustrations, logos, graphismes, vidéos, créations textiles, modèles, ainsi que leur mise en page, sont protégés par les dispositions du Code de la propriété intellectuelle.</p>
                <p class="mt-2">Sauf autorisation écrite préalable, toute reproduction, représentation, diffusion, adaptation ou exploitation, totale ou partielle, de ces éléments est interdite.</p>
            </section>

            <hr class="border-stone-100">

            {{-- Accès au site --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Accès au site</h2>
                <p>Le site est accessible 24 heures sur 24 et 7 jours sur 7, sauf interruption programmée pour maintenance ou en cas de force majeure.</p>
                <p class="mt-2">Oft Atelier met tout en œuvre pour assurer l'exactitude des informations publiées. Toutefois, celles-ci sont fournies à titre indicatif et peuvent être modifiées à tout moment sans préavis.</p>
            </section>

            <hr class="border-stone-100">

            {{-- Responsabilité --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Responsabilité</h2>
                <p>Oft Atelier s'efforce d'assurer l'exactitude et la mise à jour des informations diffusées sur le site. Toutefois, l'éditeur ne saurait être tenu responsable :</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>des erreurs ou omissions présentes sur le site ;</li>
                    <li>d'une interruption temporaire du service ;</li>
                    <li>d'éventuels dommages résultant de l'utilisation du site ou de l'impossibilité d'y accéder.</li>
                </ul>
                <p class="mt-2">L'utilisateur demeure seul responsable de l'utilisation qu'il fait des informations disponibles.</p>
            </section>

            <hr class="border-stone-100">

            {{-- Liens hypertextes --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Liens hypertextes</h2>
                <p>Le site peut contenir des liens vers des sites internet tiers. Oft Atelier n'exerce aucun contrôle sur le contenu de ces sites et ne saurait être tenu responsable des informations, produits ou services qu'ils proposent.</p>
            </section>

            <hr class="border-stone-100">

            {{-- Données personnelles & Cookies --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Données personnelles & Cookies</h2>
                <p>Le traitement des données personnelles est réalisé conformément au RGPD et à la loi Informatique et Libertés. Pour en savoir plus, consultez notre <a href="{{ route('legal.privacy') }}" class="text-[#82C341] font-semibold underline">Politique de confidentialité</a>.</p>
            </section>

            <hr class="border-stone-100">

            {{-- Droit applicable --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">Droit applicable</h2>
                <p>Les présentes mentions légales sont régies par le droit français. En cas de litige et à défaut de résolution amiable, les juridictions françaises seront seules compétentes.</p>
            </section>

        </div>

    </div>
</div>
@endsection