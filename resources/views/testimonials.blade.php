<x-app-layout>
    <div class="py-12 bg-[#FDFBF7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-serif text-center text-gray-800 mb-2">Les Témoignages de nos Élèves</h1>
            <p class="text-center text-gray-600 mb-10">Découvrez ce que les participants pensent de nos ateliers couture et confections.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($testimonials as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition duration-200">
                        <div>
                            <!-- Affichage de la note en étoiles -->
                            <div class="flex text-amber-400 mb-3 text-lg">
                                @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                                    ★
                                @endfor
                            </div>
                            <!-- Contenu du message -->
                            <p class="text-gray-600 italic mb-6">"{{ $testimonial->content }}"</p>
                        </div>
                        <div class="border-t pt-4 border-gray-50">
                            <p class="font-semibold text-gray-800">{{ $testimonial->author }}</p>
                            @if($testimonial->role)
                                <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <p>Aucun témoignage n'est disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
