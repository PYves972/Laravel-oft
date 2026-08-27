
<x-app-layout>

    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-8">
            Calendrier des ateliers
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            @foreach ($days as $day)

                <div class="border rounded-lg overflow-hidden bg-white shadow">

                    {{-- En-tête du jour --}}
                    <div class="bg-gray-100 p-4 text-center">
                        <h2 class="font-bold">
                            {{ ucfirst($day->locale('fr')->translatedFormat('l')) }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $day->format('d/m') }}
                        </p>
                    </div>

                    {{-- Séances du jour --}}
                    <div class="p-3 space-y-3">

                        @foreach (
                            $sessions
                                ->where('start_at', '>=', $day->copy()->startOfDay())
                                ->where('start_at', '<=', $day->copy()->endOfDay())
                            as $session
                        )

                            <div
                                class="rounded-lg p-3 text-white"
                                style="background-color: {{ $session->training->color ?? '#6B7280' }}"
                            >

                                {{-- Nom de la formation --}}
                                <div class="font-bold">
                                    {{ $session->training->title }}
                                </div>

                                {{-- Horaires --}}
                                <div class="text-sm mt-1">
                                    {{ $session->start_at->format('H:i') }}
                                    →
                                    {{ $session->end_at->format('H:i') }}
                                </div>


                                {{-- ========================================= --}}
                                {{-- UTILISATEUR DÉJÀ INSCRIT --}}
                                {{-- ========================================= --}}

                                @if ($session->is_reserved)

                                    <div class="text-sm mt-2">
                                        {{ $session->remaining_seats }}
                                        place(s) restante(s)
                                    </div>

                                    <div class="text-sm mt-2 font-semibold">
                                        Réservé
                                    </div>

                                    <form
                                        method="POST"
                                        action="{{ route('bookings.cancel', $session->user_booking) }}"
                                        class="mt-3"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-full rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-100"
                                        >
                                            Annuler
                                        </button>
                                    </form>


                                {{-- ========================================= --}}
                                {{-- SÉANCE COMPLÈTE --}}
                                {{-- ========================================= --}}

                                @elseif ($session->is_full)

                                    <div class="text-sm mt-2 font-semibold">
                                        Complet
                                    </div>


                                {{-- ========================================= --}}
                                {{-- SÉANCE DISPONIBLE --}}
                                {{-- ========================================= --}}

                                @else

                                    <div class="text-sm mt-2">
                                        {{ $session->remaining_seats }}
                                        place(s) restante(s)
                                    </div>

                                    @auth

                                        {{-- Utilisateur connecté --}}
                                        <form
                                            method="POST"
                                            action="{{ route('bookings.store', $session) }}"
                                            class="mt-3"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="w-full rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-100"
                                            >
                                                Réserver
                                            </button>
                                        </form>

                                    @else

                                        {{-- Visiteur --}}
                                        <a
                                            href="{{ route('login') }}"
                                            class="mt-3 block w-full rounded-md bg-white px-3 py-2 text-center text-sm font-semibold text-gray-800 hover:bg-gray-100"
                                        >
                                            Se connecter pour réserver
                                        </a>

                                    @endauth

                                @endif

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>
