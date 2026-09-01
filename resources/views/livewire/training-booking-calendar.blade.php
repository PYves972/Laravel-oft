<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-sm border border-gray-100">

    <!-- Sélecteur d'atelier & En-tête -->
    <div class="mb-8 space-y-4">
        <div class="w-full sm:w-1/2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Choisir un atelier :</label>
            <select wire:model.live="selectedTrainingId" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                @foreach($trainings as $trainingItem)
                    <option value="{{ $trainingItem->id }}">{{ $trainingItem->title }}</option>
                @endforeach
            </select>
        </div>

        @if($selectedTraining)
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-t border-gray-100">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $selectedTraining->title }}</h1>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                            {{ $selectedTraining->type ?? 'Atelier' }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-amber-500 text-white">
                            {{ $selectedTraining->level ?? 'Tous niveaux' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 10 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-right">
                        <div class="text-3xl font-extrabold text-gray-900">
                            {{ number_format($selectedTraining->price, 2, ',', ' ') }}€
                        </div>
                        <div class="text-xs text-gray-500">
                            Le cours
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Grille de réservation -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

        <!-- Calendrier -->
        <div class="md:col-span-6 lg:col-span-5 border border-gray-200 rounded-2xl p-4 shadow-sm">
            <div class="flex justify-between items-center mb-4 px-2">
                <button wire:click="previousMonth" class="p-1 hover:bg-gray-100 rounded-lg text-gray-600 font-bold">&laquo;</button>
                <span class="font-semibold text-gray-800 capitalize">{{ $monthLabel }}</span>
                <button wire:click="nextMonth" class="p-1 hover:bg-gray-100 rounded-lg text-gray-600 font-bold">&raquo;</button>
            </div>

            <div class="grid grid-cols-5 text-center font-medium text-xs text-gray-700 mb-2">
                <span>ma</span><span>me</span><span>j</span><span>v</span><span>s</span>
            </div>

            <div class="grid grid-cols-5 gap-y-1 text-center text-sm">
                @foreach($calendarDays as $day)
                    @php $isSelected = $selectedDate === $day['date']; @endphp
                    <div class="relative py-1 flex items-center justify-center">
                        @if($day['is_disabled'])
                            <span class="text-gray-300 line-through select-none">{{ $day['day_number'] }}</span>
                        @else
                            <button wire:click="selectDate('{{ $day['date'] }}')"
                                    class="w-8 h-8 rounded-lg flex flex-col items-center justify-center transition-all relative {{ $isSelected ? 'bg-gray-900 text-white font-bold' : 'text-gray-800 hover:bg-gray-100' }}">
                                {{ $day['day_number'] }}
                                <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-emerald-500"></span>
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Panneau Créneaux & Action de réservation -->
        <div class="md:col-span-6 lg:col-span-7 space-y-4">
            @forelse($selectedSessions as $session)
                @php
                    $maxCapacity = $session->capacity_override ?? $selectedTraining->capacity ?? 6;
                    $remainingPlaces = max(0, $maxCapacity - $session->bookings_count);
                @endphp
                <div class="border-2 border-emerald-600 rounded-2xl p-5 bg-white shadow-sm flex flex-col justify-between gap-4">
                    <div>
                        <div class="text-xl font-semibold text-slate-800 mb-2">
                            {{ \Carbon\Carbon::parse($session->starts_at)->format('H\hi') }} - {{ \Carbon\Carbon::parse($session->ends_at)->format('H\hi') }}
                        </div>
                        <div class="flex items-center gap-2 text-emerald-600 font-medium text-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span>
                            {{ $remainingPlaces }} {{ \Illuminate\Support\Str::plural('place restante', $remainingPlaces) }}
                        </div>
                    </div>

                    <!-- Bouton de réservation -->
                    @auth
                        @if($remainingPlaces > 0)
                            <button wire:click="bookSession({{ $session->id }})"
                                    wire:loading.attr="disabled"
                                    class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow transition duration-150">
                                <span wire:loading.remove wire:target="bookSession({{ $session->id }})">Réserver ce créneau</span>
                                <span wire:loading wire:target="bookSession({{ $session->id }})">Réservation en cours...</span>
                            </button>
                        @else
                            <button disabled class="w-full py-2.5 px-4 bg-gray-200 text-gray-500 font-semibold rounded-xl cursor-not-allowed">
                                Complet
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block text-center w-full py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition duration-150">
                            Connectez-vous pour réserver
                        </a>
                    @endauth
                </div>
            @empty
                <div class="border border-dashed border-gray-300 rounded-2xl p-6 text-center text-gray-500">
                    Aucun créneau disponible pour cette date.
                </div>
            @endforelse
        </div>

    </div>
</div>
