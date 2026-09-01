@extends('layouts.main')

@section('content')

<div class="min-h-screen bg-[#F9F8F3] pt-28 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="font-serif text-3xl font-bold text-[#2D3B22]">Mon Tableau de bord</h1>
                <p class="text-sm text-gray-600 mt-1">Bienvenue {{ Auth::user()->name ?? '' }} !</p>
            </div>

            <a href="{{ route('training-calendar.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-[#2D3B22] hover:bg-[#1e2817] rounded-full transition">
                Voir le calendrier
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
            <h2 class="font-serif text-xl font-bold text-[#2D3B22] mb-4">Mes réservations</h2>

            @if(isset($bookings) && count($bookings) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($bookings as $booking)
                        <div class="bg-[#F2EFE9] p-4 rounded-xl space-y-3">
                            <h3 class="font-bold text-gray-900">
                                {{ $booking->trainingSession->training->title ?? $booking->trainingSession->title ?? 'Atelier' }}
                            </h3>

                            <!-- FORMULAIRE COMPATIBLE METHOD DELETE (Empêche l'erreur 405) -->
                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Confirmer l\'annulation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white font-semibold text-xs rounded-lg transition">
                                    Annuler la réservation
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">Aucune réservation pour le moment.</p>
            @endif
        </div>

    </div>
</div>

@endsection
