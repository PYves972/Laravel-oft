<x-app-layout>
    <div class="py-12 bg-[#FDFBF7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-serif text-center text-gray-800 mb-8">Galerie de l'Atelier</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($images as $image)
                    <div class="overflow-hidden rounded-lg shadow-sm border border-gray-100 bg-white">
                        <img src="{{ asset($image) }}"
                             alt="Création de l'Atelier"
                             class="w-full h-64 object-cover hover:scale-105 transition duration-300">
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <p>Aucune image disponible dans la galerie pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
