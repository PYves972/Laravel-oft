<x-app-layout>
    {{-- On remplace py-12 par pt-28 pb-12 pour décaler correctement le contenu sous la navbar fixe --}}
    <div class="pt-28 pb-12 bg-[#FDFBF7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-serif text-center text-gray-800 mb-8">Galerie de l'Atelier</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($images as $image)
                    {{-- 
                       1. aspect-[3/4] ou aspect-square : donne un ratio vertical moderne et uniforme aux cartes.
                       2. h-full w-full object-cover : remplit intégralement la carte sans déformer l'image ni laisser de bandes blanches.
                    --}}
                    <div class="overflow-hidden rounded-xl shadow-sm border border-gray-100 bg-white aspect-[3/4] relative group">
                        <img src="{{ asset($image) }}"
                             alt="Création de l'Atelier"
                             class="w-full h-full object-cover transform transition-transform duration-500 ease-in-out group-hover:scale-110">
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
