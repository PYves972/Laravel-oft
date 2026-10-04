@extends('layouts.main')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="font-serif text-4xl text-center text-[#2D3B22] mb-12">Galerie de l'Atelier</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset('storage/' . $service->image_path) }}"
                     alt="{{ $service->title }}"
                     class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 text-lg">{{ $service->title }}</h3>
                    @if($service->description)
                        <p class="text-sm text-gray-600 mt-1">{{ $service->description }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-12">Aucune image disponible dans la galerie pour le moment.</p>
        @endforelse
    </div>
</section>
@endsection
