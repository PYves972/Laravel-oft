<div class="min-h-screen bg-[#F9F8F3] pt-28 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- En-tête Espace Membre -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl border border-stone-200 shadow-sm">
            <div>
                <h1 class="text-3xl font-serif text-stone-900">Espace Membre</h1>
                <p class="text-stone-600 mt-1">Bienvenue, {{ auth()->user()->name ?? 'Membre' }} ! Retrouvez ici vos ateliers et formations.</p>
            </div>
<div class="flex flex-wrap gap-3">
    <!-- Bouton Ateliers -->
    <a href="{{ route('trainings.workshops') }}" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-800 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <span>🎨</span> Nos Ateliers
    </a>

    <!-- Bouton Formations -->
    <a href="{{ route('trainings.workshops', ['type' => 'formation']) }}" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-800 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <span>🎓</span> Nos Formations
    </a>

    <!-- Bouton Calendrier -->
    <a href="{{ route('web.calendar') }}" class="px-4 py-2 bg-[#2D3B22] hover:bg-[#1e2817] text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <span>📅</span> Calendrier & Réservations
    </a>
</div>
        </div>

        <!-- Messages Flash -->
        @if (session()->has('success'))
            <div class="p-4 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-4 text-sm text-rose-800 bg-rose-50 rounded-xl border border-rose-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- Section Séances à venir -->
        <section class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
            <h2 class="font-serif text-xl font-bold text-[#2D3B22] mb-4 flex items-center space-x-2">
                <span>📅</span>
                <span>Mes séances à venir</span>
            </h2>

            @forelse($upcomingBookings ?? [] as $booking)
                <div class="bg-white border border-stone-200 rounded-xl p-5 mb-4 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 mb-2">
                            {{ ucfirst($booking->trainingSession?->training?->type ?? 'Atelier') }}
                        </span>
                        <h3 class="text-lg font-bold text-stone-900">
                            {{ $booking->trainingSession?->training?->title ?? $booking->trainingSession?->title ?? 'Atelier' }}
                        </h3>
                        <p class="text-sm text-stone-600 mt-1">
                            🗓️ {{ $booking->trainingSession?->starts_at?->format('d/m/Y') }}
                            de {{ $booking->trainingSession?->starts_at?->format('H:i') }} à {{ $booking->trainingSession?->ends_at?->format('H:i') }}
                        </p>
                    </div>

                    <div class="flex items-center space-x-3 w-full md:w-auto justify-end">
                        <button
                            wire:click="cancelBooking({{ $booking->id }})"
                            wire:confirm="Êtes-vous sûr de vouloir annuler votre réservation ?"
                            class="text-xs text-rose-600 hover:text-rose-800 font-medium px-3 py-2 rounded-lg hover:bg-rose-50 transition-colors">
                            Annuler ma réservation
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-stone-500">
                    <p>Vous n'avez aucune réservation à venir.</p>
                    <a href="{{ route('web.calendar') }}" class="inline-block mt-3 px-4 py-2 bg-[#2D3B22] text-white rounded-lg text-sm hover:bg-[#1e2817] transition-colors">
                        Consulter le calendrier
                    </a>
                </div>
            @endforelse
        </section>

        <!-- Section Historique -->
        <section class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
            <h2 class="font-serif text-xl font-bold text-[#2D3B22] mb-4 flex items-center space-x-2">
                <span>📚</span>
                <span>Historique & Formations suivies</span>
            </h2>

            @forelse($pastBookings ?? [] as $booking)
                <div class="bg-stone-50 border border-stone-200 rounded-xl p-5 mb-4 opacity-80 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-600' }}">
                                {{ $booking->status === 'confirmed' ? 'Séance effectuée' : 'Annulée' }}
                            </span>
                        </div>
                        <h3 class="text-base font-bold text-stone-800">
                            {{ $booking->trainingSession?->training?->title ?? 'Titre indisponible' }}
                        </h3>
                        <p class="text-xs text-stone-500 mt-1">
                            Du {{ $booking->trainingSession?->starts_at?->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-stone-500 text-sm">
                    Aucune formation passée dans votre historique.
                </div>
            @endforelse
        </section>

    </div>
</div>
