@extends('layouts.main')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="font-serif text-4xl text-center text-[#2D3B22] mb-12">Galerie de l'Atelier</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($images as $imagePath)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-lg">
                <div class="w-full h-72 overflow-hidden bg-gray-50 flex items-center justify-center">
                    <img src="{{ asset($imagePath) }}"
                         alt="Réalisation Galerie"
                         class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-12">Aucune image présente dans la galerie pour le moment.</p>
        @endforelse
    </div>
</section>
@endsection
