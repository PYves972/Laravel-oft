<x-app-layout>
    <div class="py-12 bg-stone-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- En-tête -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-3">
                    Nos Ateliers & Formations
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Découvrez nos différents ateliers de couture et sélectionnez votre créneau directement sur notre calendrier en ligne.
                </p>
            </div>

            <!-- Grille des ateliers -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($trainings as $training)
                    @php
                        // Couleur de l'atelier (avec une couleur verte par défaut si non définie)
                        $accentColor = $training->color ?? '#10B981';
                    @endphp

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition duration-200">

                        <!-- Bordure supérieure personnalisée avec la couleur de l'atelier -->
                        <div class="p-6" style="border-top: 6px solid {{ $accentColor }};">

                            <!-- Badges : Catégorie & Durée -->
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold text-white shadow-sm" style="background-color: {{ $accentColor }};">
                                    {{ $training->category->name ?? 'Atelier' }}
                                </span>

                                <div class="flex items-center text-xs font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 10 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ floor($training->duration_minutes / 60) }}h{{ sprintf('%02d', $training->duration_minutes % 60) }}
                                </div>
                            </div>

                            <!-- Titre -->
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                {{ $training->title }}
                            </h2>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ $training->description }}
                            </p>
                        </div>

                        <!-- Pied de carte : Tarif et Boutons -->
                        <div class="p-6 bg-stone-50/60 border-t border-gray-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 mt-auto">
                            <div>
                                <span class="text-xs text-gray-500 block font-medium">Tarif</span>
                                <span class="text-2xl font-extrabold text-gray-900">
                                    {{ number_format($training->price, 2, ',', ' ') }}€
                                </span>
                            </div>

                            <div class="flex items-center gap-2">
                                <!-- Lien vers la fiche de l'atelier -->
                                <a href="{{ route('trainings.show', $training->slug) }}"
                                   class="px-3 py-2.5 rounded-xl font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 transition text-sm text-center">
                                    Détails
                                </a>

                                <!-- Bouton vers le Calendrier avec sélection automatique -->
                                <a href="{{ route('training-calendar.index', ['training' => $training->id]) }}"
                                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-semibold text-white shadow-sm transition duration-150 hover:opacity-90 text-sm"
                                   style="background-color: {{ $accentColor }};">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Réserver
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-500 text-base">Aucun atelier n'est disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
