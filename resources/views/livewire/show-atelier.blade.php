<div class="max-w-7xl mx-auto pt-32 pb-12 px-4 sm:px-6 lg:px-8">

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-100 text-emerald-800 rounded-xl font-medium shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

        <!-- COLONNE GAUCHE : Details -->
        <div>
            @php
                // 1. Récupération du nom de fichier (détecte 'image' ou 'image_path')
                $imgSrc = $training->image ?? $training->image_path;

                // 2. Construction de l'URL finale
                if ($imgSrc) {
                    // Si l'image est un chemin Filament / Storage
                    if (str_starts_with($imgSrc, 'trainings/') || str_starts_with($imgSrc, 'ateliers/')) {
                        $imageUrl = asset('storage/' . $imgSrc);
                    } else {
                        // Si c'est un fichier du dossier public/images/
                        $imageUrl = asset('images/' . $imgSrc);
                    }
                } else {
                    // Image par défaut si le champ est vide
                    $imageUrl = asset('images/atelier.jpg');
                }
            @endphp

            <img src="{{ $imageUrl }}"
                 alt="{{ $training->title }}"
                 class="w-full h-96 object-cover rounded-2xl shadow-md mb-6"
                 onerror="this.onerror=null; this.src='{{ asset('images/atelier.jpg') }}';">

            <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                {{ $training->category->name ?? 'Couture' }}
            </span>

            <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $training->title }}</h1>

            <div class="prose max-w-none text-gray-600 leading-relaxed">
                {!! $training->description !!}
            </div>
        </div>

        <!-- COLONNE DROITE : Carte de Reservation -->
        <div class="bg-white border border-gray-200 shadow-xl rounded-2xl p-6 relative">

            <!-- Prix & Duree -->
            <div class="flex justify-between items-baseline mb-6 pb-4 border-b border-gray-100">
                <span class="text-3xl font-black text-gray-900">{{ number_format($training->price, 2, ',', ' ') }} €</span>
                <span class="text-sm font-semibold text-gray-500">Durée : {{ $training->duration_minutes }} min</span>
            </div>

            <!-- Calendrier -->
            <div class="mb-6">
                <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-4">1. Choisissez une date</h3>

                <!-- Jours de la semaine -->
                <div class="grid grid-cols-7 gap-1 text-center text-xs font-bold text-gray-600 mb-2">
                    <span>L</span><span>M</span><span>M</span><span>J</span><span>V</span><span>S</span><span>D</span>
                </div>

                @php
                    $month = \Carbon\Carbon::parse($selectedMonth ?? now()->format('Y-m-01'))->startOfMonth();
                    $calendarStart = $month->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                    $calendarEnd = $month->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);
                @endphp

                <!-- Grille des jours -->
                <div class="grid grid-cols-7 gap-1.5">
                    @for ($date = $calendarStart->copy(); $date->lte($calendarEnd); $date->addDay())
                        @php
                            $dateStr = $date->format('Y-m-d');
                            $hasSession = is_array($availableDates) && in_array($dateStr, $availableDates);
                            $isSelected = $selectedDate === $dateStr;
                            $isCurrentMonth = $date->month === $month->month;
                        @endphp

                        <button
                            type="button"
                            wire:click="selectDate('{{ $dateStr }}')"
                            @disabled(!$hasSession || !$isCurrentMonth)
                            @class([
                                'h-10 w-full rounded-xl flex items-center justify-center font-bold text-sm transition-all',
                                // Mois hors-champ
                                'text-gray-300 bg-gray-50/50 cursor-not-allowed' => !$isCurrentMonth,
                                // Date selectionnee
                                'bg-rose-500 text-white shadow-md font-extrabold ring-2 ring-rose-300' => $isSelected && $isCurrentMonth,
                                // Session disponible (cliquable)
                                'bg-emerald-500 text-white hover:bg-emerald-600 shadow-sm cursor-pointer' => $hasSession && !$isSelected && $isCurrentMonth,
                                // Jour sans session (lisible mais inactif)
                                'text-gray-500 bg-gray-100 hover:bg-gray-100 cursor-not-allowed' => !$hasSession && $isCurrentMonth,
                            ])
                        >
                            {{ $date->day }}
                        </button>
                    @endfor
                </div>
            </div>

            <!-- Horaires -->
            @if($selectedDate)
                <div class="mb-6">
                    <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">2. Sélectionnez l'horaire</h3>

                    @if(!empty($sessionsForSelectedDate) && $sessionsForSelectedDate->isNotEmpty())
                        <div class="space-y-2.5">
                            @foreach($sessionsForSelectedDate as $session)
                                <button
                                    type="button"
                                    wire:click="selectSession({{ $session->id }})"
                                    @class([
                                        'w-full p-3.5 rounded-xl border text-left flex justify-between items-center transition',
                                        'border-rose-500 bg-rose-50/50 ring-2 ring-rose-500' => $selectedSessionId === $session->id,
                                        'border-gray-200 hover:border-gray-300 bg-white' => $selectedSessionId !== $session->id,
                                    ])
                                >
                                    <div>
                                        <span class="text-sm font-bold text-gray-900 block">
                                            {{ \Carbon\Carbon::parse($session->starts_at)->format('H\hi') }} - {{ \Carbon\Carbon::parse($session->ends_at)->format('H\hi') }}
                                        </span>
                                        <span class="text-xs text-emerald-600 font-semibold">
                                            ● {{ $session->capacity }} place(s) disponible(s)
                                        </span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-500 italic">Aucun créneau disponible pour cette date.</p>
                    @endif
                </div>
            @endif

            <!-- Bouton Reserver -->
            <button
                type="button"
                wire:click="addToCart"
                @disabled(!$selectedSessionId)
                class="w-full py-3.5 bg-rose-500 hover:bg-rose-600 disabled:bg-gray-200 text-white font-extrabold rounded-xl shadow-md transition text-center text-base disabled:cursor-not-allowed disabled:text-gray-400 mt-2"
            >
                Confirmer la réservation
            </button>

        </div>

    </div>
</div>
