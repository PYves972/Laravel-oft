@extends('layouts.main')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="font-serif text-4xl text-center text-[#2D3B22] mb-12">Galerie de l'Atelier</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($images as $imagePath)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset($imagePath) }}"
                     alt="Réalisation Atelier"
                     class="w-full h-64 object-cover">
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-12">Aucune image présente dans le dossier de la galerie.</p>
        @endforelse
    </div>
</section>
@endsection
