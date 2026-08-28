<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-8 font-serif text-[#2D3B22]">
            Calendrier des ateliers
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @foreach ($days as $day)
                <div class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm">

                    {{-- En-tête du jour --}}
                    <div class="bg-[#F2EFE9] p-4 text-center">
                        <h2 class="font-bold font-serif text-[#2D3B22]">
                            {{ ucfirst($day->locale('fr')->translatedFormat('l')) }}
                        </h2>
                        <p class="text-xs text-gray-500">
                            {{ $day->format('d/m') }}
                        </p>
                    </div>

                    {{-- Liste des séances du jour --}}
                    <div class="p-3 space-y-3 min-h-[160px]">
                        @php
                            $daySessions = $sessions->filter(fn($s) => $s->starts_at && $s->starts_at->isSameDay($day));
                        @endphp

                        @forelse ($daySessions as $session)
                            <div class="rounded-xl p-3 text-white shadow-sm"
                                 style="background-color: {{ $session->training->color ?? '#2D3B22' }};">

                                <div class="font-bold text-sm">
                                    {{ $session->training->title ?? 'Atelier' }}
                                </div>

                                <div class="text-xs mt-1 opacity-90">
                                    {{ $session->starts_at?->format('H:i') }}
                                    @if($session->ends_at)
                                        → {{ $session->ends_at->format('H:i') }}
                                    @endif
                                </div>

                                <div class="text-xs mt-2 opacity-90">
                                    {{ $session->remaining_seats }} place(s) restante(s)
                                </div>

                                @if ($session->is_reserved)
                                    <div class="text-xs mt-2 font-semibold bg-white/20 px-2 py-1 rounded text-center">
                                        Réservé
                                    </div>
                                @elseif ($session->is_full)
                                    <div class="text-xs mt-2 font-semibold bg-black/20 px-2 py-1 rounded text-center">
                                        Complet
                                    </div>
                                @else
                                    @auth
                                        <form method="POST" action="{{ route('bookings.store', $session) }}" class="mt-3">
                                            @csrf
                                            <button type="submit" class="w-full rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-100 transition shadow-sm">
                                                Réserver
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="mt-3 block w-full rounded-lg bg-white px-3 py-1.5 text-center text-xs font-semibold text-gray-800 hover:bg-gray-100 transition shadow-sm">
                                            Se connecter
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-gray-400">
                                Pas d'atelier
                            </div>
                        @endforelse
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
