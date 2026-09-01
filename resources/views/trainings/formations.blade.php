@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#F9F8F3] pt-28 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <div class="text-center max-w-3xl mx-auto space-y-3">
            <h1 class="font-serif text-4xl font-bold text-[#2D3B22]">Nos Formations de Couture</h1>
            <p class="text-gray-600">Développez vos compétences en couture, de l'initiation au perfectionnement sur machine.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($trainings as $training)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full text-white" style="background-color: {{ $training->color ?? '#82C341' }}">
                                {{ $training->category->name ?? 'Couture' }}
                            </span>
                            <span class="text-xs text-gray-500 font-medium">⏱ {{ $training->duration ?? '2h00' }}</span>
                        </div>
                        <h3 class="font-serif text-xl font-bold text-gray-900">{{ $training->title }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $training->description }}</p>
                    </div>

                    <div class="p-6 pt-0 flex items-center justify-between border-t border-gray-100 mt-4">
                        <div>
                            <span class="text-xs text-gray-400 block">Tarif</span>
                            <span class="font-bold text-xl text-gray-900">{{ number_format($training->price, 2, ',', ' ') }}€</span>
                        </div>
                        <a href="{{ route('training-calendar.index', ['training' => $training->id]) }}"
                           class="px-5 py-2.5 rounded-xl text-xs font-semibold text-white shadow-sm transition hover:opacity-90"
                           style="background-color: {{ $training->color ?? '#82C341' }}">
                            Réserver
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Aucune formation disponible pour le moment.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
