<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $training->title }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifications Flash --}}
            @if(session('success'))
                <div class="p-4 text-sm text-green-800 bg-green-100 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 text-sm text-red-800 bg-red-100 rounded-lg shadow-sm">
                    {{ session('error') }}
                </div>
            @endif


            {{-- ============================= --}}
            {{-- DÉTAILS DE LA FORMATION --}}
            {{-- ============================= --}}

            <div class="p-6 bg-white shadow sm:rounded-lg">

                <span class="text-xs font-semibold uppercase px-2 py-1 bg-indigo-100 text-indigo-800 rounded">
                    {{ $training->category->name ?? 'Formation' }}
                </span>

                <h1 class="text-3xl font-bold text-gray-900 mt-2">
                    {{ $training->title }}
                </h1>

                <p class="text-gray-700 mt-4 text-lg">
                    {{ $training->description }}
                </p>

                {{-- Objectifs pédagogiques --}}
                @if($training->learning_objectives)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Objectifs pédagogiques
                        </h3>
                        <p class="text-gray-600 mt-1 whitespace-pre-line">
                            {{ $training->learning_objectives }}
                        </p>
                    </div>
                @endif

                {{-- Tags --}}
                @if($training->tags && $training->tags->count() > 0)
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($training->tags as $tag)
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

            </div>


            {{-- ============================= --}}
            {{-- CALENDRIER DE RÉSERVATION --}}
            {{-- ============================= --}}

            <div class="p-6 bg-white shadow sm:rounded-lg">

                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    Réserver un créneau
                </h3>

                {{-- Composant Livewire interactif --}}
                <livewire:training-booking-calendar :training="$training" />

            </div>

        </div>

    </div>

</x-app-layout>
