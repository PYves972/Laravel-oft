<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $training->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Notifications de succès / erreur -->
            @if(session('success'))
                <div class="p-4 text-sm text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 text-sm text-red-800 bg-red-100 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Détails de la formation -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <span class="text-xs font-semibold uppercase px-2 py-1 bg-indigo-100 text-indigo-800 rounded">
                    {{ $training->category->name }}
                </span>

                <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $training->title }}</h1>

                <p class="text-gray-700 mt-4 text-lg">{{ $training->description }}</p>

                @if($training->learning_objectives)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900">Objectifs pédagogiques</h3>
                        <p class="text-gray-600 mt-1 whitespace-pre-line">{{ $training->learning_objectives }}</p>
                    </div>
                @endif

                <div class="mt-6 flex items-center space-x-6 text-gray-600">
                    <div>
                        <span class="font-bold text-xl text-gray-900">{{ number_format($training->price, 2) }} €</span>
                    </div>
                    <div>
                        <span class="font-medium">Durée :</span> {{ $training->duration_minutes }} minutes
                    </div>
                </div>
            </div>

            <!-- Prochaines séances disponibles -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Prochaines séances disponibles</h3>

                @if($training->sessions->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($training->sessions as $session)
                            @php
                                $confirmedBookings = $session->bookings()->where('status', 'confirmed')->count();
                                $remainingSeats = $session->capacity_max - $confirmedBookings;
                            @endphp
                            <div class="py-4 flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800 capitalize">
                                        {{ $session->start_at->locale('fr')->isoFormat('dddd D MMMM YYYY [à] HH[h]mm') }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Places restantes : <span class="font-semibold text-gray-700">{{ $remainingSeats }}</span> / {{ $session->capacity_max }}
                                    </p>
                                </div>

                                <div>
                                    @auth
                                        @if($remainingSeats > 0)
                                            <form action="{{ route('bookings.store', $session) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded uppercase tracking-wider transition duration-150">
                                                    Réserver
                                                </button>
                                            </form>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Complet
                                            </span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1.5 border border-indigo-600 text-xs font-semibold text-indigo-600 rounded hover:bg-indigo-50">
                                            Connectez-vous pour réserver
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Aucune séance planifiée pour le moment.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
