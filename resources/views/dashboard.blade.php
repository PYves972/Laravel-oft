<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">Mes Réservations</h3>

                {{-- Message de succès après une annulation --}}
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Si l'utilisateur n'a aucune réservation active --}}
                @if($bookings->isEmpty())
                    <p class="text-gray-500">Vous n'avez aucune réservation en cours.</p>
                @else
                    {{-- Liste des réservations --}}
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                            <div class="border p-4 rounded-lg flex justify-between items-center bg-gray-50">
                                <div>
                                    <h4 class="font-semibold text-lg text-gray-800">
                                        {{ $booking->trainingSession->training->title }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Date : {{ $booking->trainingSession->starts_at?->format('d/m/Y à H:i') }}
                                        @if($booking->trainingSession->ends_at)
                                            → {{ $booking->trainingSession->ends_at->format('H:i') }}
                                        @endif
                                    </p>
                                </div>

                                {{-- Bouton pour annuler la réservation --}}
                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Voulez-vous vraiment annuler cette réservation ?')"
                                            class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700 transition">
                                        Annuler
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
