

<x-app-layout>

    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-8">
            Calendrier des ateliers
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            @foreach ($days as $day)

                <div class="border rounded-lg overflow-hidden bg-white shadow">

                    <div class="bg-gray-100 p-4 text-center">
                        <h2 class="font-bold">
                            {{ ucfirst($day->locale('fr')->translatedFormat('l')) }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $day->format('d/m') }}
                        </p>
                    </div>

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

                                <div class="font-bold">
                                    {{ $session->training->title }}
                                </div>

                                <div class="text-sm mt-1">
                                    {{ $session->start_at->format('H:i') }}
                                    →
                                    {{ $session->end_at->format('H:i') }}
                                </div>

                                <div class="text-sm mt-2">
                                    {{ $session->remainingSeats() }}
                                    place(s) disponible(s)
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>
