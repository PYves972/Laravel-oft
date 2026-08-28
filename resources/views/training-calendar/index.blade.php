<x-app-layout>
    <div class="container mx-auto px-4 py-8 space-y-6">

        {{-- Titre et Barre de Navigation par semaine --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h1 class="text-3xl font-bold font-serif text-[#2D3B22]">
                Calendrier des ateliers
            </h1>

            <div class="flex items-center gap-3 bg-white p-2 rounded-xl border border-gray-100 shadow-sm self-start md:self-auto">
                <a
                    href="{{ route('training-calendar.index', ['week' => $prevWeek]) }}"
                    class="px-3 py-1.5 text-xs font-semibold text-[#2D3B22] bg-[#F2EFE9] hover:bg-[#e4dfd5] rounded-lg transition"
                >
                    &larr; Semaine précédente
                </a>

                <span class="text-xs font-bold text-[#2D3B22] px-2">
                    Du {{ $days->first()->locale('fr')->translatedFormat('d F') }} au {{ $days->last()->locale('fr')->translatedFormat('d F Y') }}
                </span>

                <a
                    href="{{ route('training-calendar.index', ['week' => $nextWeek]) }}"
                    class="px-3 py-1.5 text-xs font-semibold text-[#2D3B22] bg-[#F2EFE9] hover:bg-[#e4dfd5] rounded-lg transition"
                >
                    Semaine suivante &rarr;
                </a>
            </div>
        </div>

        {{-- Bouton de retour rapide vers la semaine actuelle --}}
        @if(isset($startOfWeek) && !$startOfWeek->isCurrentWeek())
            <div class="text-right">
                <a href="{{ route('training-calendar.index') }}" class="text-xs text-gray-500 hover:text-[#2D3B22] underline">
                    &circlearrowright; Revenir à la semaine actuelle
                </a>
            </div>
        @endif

        {{-- Grille des 5 jours --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @foreach ($days as $day)
                @php
                    $dayKey = $day->format('Y-m-d');
                    $daySessions = $sessions->get($dayKey, collect());
                @endphp

                <div class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm flex flex-col">

                    {{-- En-tête du jour --}}
                    <div class="bg-[#F2EFE9] p-4 text-center border-b border-gray-100">
                        <h2 class="font-bold font-serif text-[#2D3B22] capitalize">
                            {{ $day->locale('fr')->translatedFormat('l') }}
                        </h2>
                        <p class="text-xs text-gray-500">
                            {{ $day->format('d/m') }}
                        </p>
                    </div>

                    {{-- Liste des séances du jour --}}
                    <div class="p-3 space-y-3 min-h-[160px] flex-1 flex flex-col">
                        @forelse ($daySessions as $session)
                            <div class="rounded-xl p-3 text-white shadow-sm flex flex-col justify-between"
                                 style="background-color: {{ $session->training->color ?? '#2D3B22' }};">

                                <div>
                                    <div class="font-bold text-sm">
                                        {{ $session->training->title ?? 'Atelier' }}
                                    </div>

                                    <div class="text-xs mt-1 opacity-90">
                                        {{ $session->starts_at?->format('H:i') }}
                                        @if($session->ends_at)
                                            &rarr; {{ $session->ends_at->format('H:i') }}
                                        @endif
                                    </div>

                                    <div class="text-xs mt-2 opacity-90">
                                        {{ $session->remaining_seats ?? $session->available_places ?? 0 }} place(s) restante(s)
                                    </div>
                                </div>

                                {{-- État / Action de réservation --}}
                                <div class="mt-3">
                                    @if ($session->is_reserved)
                                        <div class="text-xs font-semibold bg-white/20 px-2 py-1 rounded text-center">
                                            Réservé
                                        </div>
                                    @elseif ($session->is_full)
                                        <div class="text-xs font-semibold bg-black/20 px-2 py-1 rounded text-center">
                                            Complet
                                        </div>
                                    @else
                                        @auth
                                            <form method="POST" action="{{ route('bookings.store', $session) }}">
                                                @csrf
                                                <button type="submit" class="w-full rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-100 transition shadow-sm">
                                                    Réserver
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="block w-full rounded-lg bg-white px-3 py-1.5 text-center text-xs font-semibold text-gray-800 hover:bg-gray-100 transition shadow-sm">
                                                Se connecter
                                            </a>
                                        @endauth
                                    @endif
                                </div>

                            </div>
                        @empty
                            <div class="flex-1 flex items-center justify-center text-center py-6 text-xs text-gray-400">
                                Pas d'atelier
                            </div>
                        @endforelse
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
