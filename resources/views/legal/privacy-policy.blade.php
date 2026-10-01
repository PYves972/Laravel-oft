@extends('layouts.main')

@section('content')
<div class="pt-28 pb-16 bg-stone-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-serif text-[#2D3B22] font-bold">Politique de Confidentialité</h1>
            <p class="mt-2 text-gray-600 text-sm">Protection de vos données personnelles au sein de Oft Atelier.</p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 space-y-6 text-gray-700 text-sm leading-relaxed">
            
            <p class="text-xs text-gray-400">Dernière mise à jour : 22 septembre 2026</p>

            {{-- 1. Préambule --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">1. Préambule</h2>
                <p>La présente politique de confidentialité a pour objet d'informer les utilisateurs du site Oft Atelier sur la manière dont leurs données personnelles sont collectées, utilisées, conservées et protégées.</p>
                <p class="mt-2">Oft Atelier s'engage à traiter les données personnelles dans le respect du Règlement (UE) 2016/679 du 27 avril 2016 (RGPD) et de la loi Informatique et Libertés modifiée.</p>
            </section>

            <hr class="border-stone-100">

            {{-- 2. Responsable du traitement --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">2. Responsable du traitement</h2>
                <p><strong>Oft Atelier</strong></p>
                <p>Adresse : Quartier Ermitage Gonnier, Saint-Joseph</p>
                <p>E-mail : oftcreation@gmail.com</p>
                <p>Téléphone : +596 696 92 62 64</p>
            </section>

            <hr class="border-stone-100">

            {{-- 3. Données personnelles collectées --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">3. Données personnelles collectées</h2>
                <p>Selon votre utilisation du site, nous pouvons être amenés à collecter les informations suivantes :</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>Nom et prénom</li>
                    <li>Adresse postale</li>
                    <li>Adresse e-mail</li>
                    <li>Numéro de téléphone</li>
                    <li>Adresse IP & Données de navigation</li>
                    <li>Préférences relatives aux cookies</li>
                </ul>
                <p class="mt-2 text-xs text-gray-500">Les données obligatoires sont signalées lors de la collecte.</p>
            </section>

            <hr class="border-stone-100">

            {{-- 4. Finalités du traitement --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">4. Finalités du traitement</h2>
                <p>Vos données personnelles sont collectées afin de :</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>Créer et gérer votre compte client ;</li>
                    <li>Répondre à vos demandes de contact ;</li>
                    <li>Assurer le service après-vente ;</li>
                    <li>Envoyer, avec votre consentement, des newsletters ou des offres commerciales ;</li>
                    <li>Améliorer le fonctionnement et la sécurité du site ;</li>
                    <li>Établir des statistiques anonymisées de fréquentation.</li>
                </ul>
            </section>

            <hr class="border-stone-100">

            {{-- 5. Base légale des traitements --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">5. Base légale des traitements</h2>
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>L'exécution d'un contrat :</strong> gestion des commandes et réservations ;</li>
                    <li><strong>Le respect d'obligations légales :</strong> facturation, comptabilité ;</li>
                    <li><strong>Votre consentement :</strong> newsletter, cookies non essentiels ;</li>
                    <li><strong>L'intérêt légitime d'Oft Atelier :</strong> sécurité du site, amélioration des services.</li>
                </ul>
            </section>

            <hr class="border-stone-100">

            {{-- 6. Destinataires des données --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">6. Destinataires des données</h2>
                <p>Les données sont accessibles uniquement aux personnes habilitées au sein d'Oft Atelier et à nos prestataires techniques (hébergeur, envoi d'e-mails, maintenance informatique).</p>
            </section>

            <hr class="border-stone-100">

            {{-- 7. Durée de conservation --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">7. Durée de conservation</h2>
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Compte client :</strong> jusqu'à sa suppression ou après une période d'inactivité.</li>
                    <li><strong>Formulaire de contact :</strong> 3 ans après le dernier échange.</li>
                    <li><strong>Prospection commerciale :</strong> 3 ans après le dernier contact.</li>
                </ul>
            </section>

            <hr class="border-stone-100">

            {{-- 8. Vos droits --}}
            <section>
                <h2 class="text-lg font-bold text-gray-900 mb-2">8. Vos droits</h2>
                <p>Conformément au RGPD, vous disposez d'un droit d'accès, de rectification, d'effacement, de limitation, d'opposition et de portabilité de vos données.</p>
                <p class="mt-2">Pour exercer vos droits, vous pouvez nous contacter par e-mail à : <strong>oftcreation@gmail.com</strong>.</p>
                <p class="mt-2 text-xs text-gray-500">Vous pouvez également introduire une réclamation auprès de la CNIL si vous estimez que vos droits ne sont pas respectés.</p>
            </section>

        </div>

    </div>
</div>
@endsection