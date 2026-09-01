<x-app-layout>
    <div class="py-12 bg-[#F9F8F3] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- En-tête de la page -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Nos Ateliers Créatifs</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explorez le tricot, le crochet, la teinture, la broderie et le tissage au sein de notre atelier.
                </p>
            </div>

            <!-- Grille des ateliers -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($trainings as $training)
                    @php
                        $slug = strtolower($training->category->slug ?? $training->slug ?? '');
                        $title = strtolower($training->title ?? '');

                        // Attribution des couleurs (Badges + Boutons) et des images selon l'atelier
                        if (str_contains($slug, 'tricot') || str_contains($title, 'tricot') || str_contains($slug, 'crochet') || str_contains($title, 'crochet')) {
                            // Tricot & Crochet : Violet
                            $badgeBg = 'bg-purple-600 text-white';
                            $btnBg = 'bg-purple-600 hover:bg-purple-700 text-white';
                            $imageUrl = 'https://images.unsplash.com/photo-1584992236310-6edddc08acff?auto=format&fit=crop&w=600&q=80';
                        } elseif (str_contains($slug, 'teinture') || str_contains($title, 'teinture')) {
                            // Teinture : Bleu / Vert (Teal)
                            $badgeBg = 'bg-teal-600 text-white';
                            $btnBg = 'bg-teal-600 hover:bg-teal-700 text-white';
                            $imageUrl = 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=600&q=80';
                        } elseif (str_contains($slug, 'broderie') || str_contains($title, 'broderie')) {
                            // Broderie : Orange
                            $badgeBg = 'bg-amber-500 text-white';
                            $btnBg = 'bg-amber-500 hover:bg-amber-600 text-white';
                            $imageUrl = 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?auto=format&fit=crop&w=600&q=80';
                        } elseif (str_contains($slug, 'tissage') || str_contains($title, 'tissage')) {
                            // Tissage : Rose
                            $badgeBg = 'bg-pink-500 text-white';
                            $btnBg = 'bg-pink-500 hover:bg-pink-600 text-white';
                            $imageUrl = 'https://images.unsplash.com/photo-1528458876861-544fd1761a91?auto=format&fit=crop&w=600&q=80';
                        } else {
                            // Formations & Couture : Jaune / Doré
                            $badgeBg = 'bg-amber-400 text-amber-950';
                            $btnBg = 'bg-amber-400 hover:bg-amber-500 text-amber-950 font-bold';
                            $imageUrl = 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=600&q=80';
                        }
                    @endphp

                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-lg transition duration-300">
                        <div>
                            <!-- Image d'illustration fictive -->
                            <div class="relative h-48 w-full overflow-hidden bg-gray-100">
                                <img src="{{ $training->image_path ? asset('storage/' . $training->image_path) : $imageUrl }}"
                                     alt="{{ $training->title }}"
                                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />

                                <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold text-gray-700 shadow-sm flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 10 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ floor(($training->duration_minutes ?? 120) / 60) }}h{{ sprintf('%02d', ($training->duration_minutes ?? 120) % 60) }}
                                </span>
                            </div>

                            <!-- Contenu -->
                            <div class="p-6">
                                <span class="px-3.5 py-1 rounded-full text-xs font-bold inline-block mb-3 shadow-sm {{ $badgeBg }}">
                                    {{ $training->category->name ?? $training->title }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $training->title }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ Str::limit($training->description, 110) }}
                                </p>
                            </div>
                        </div>

                        <!-- Pied de carte -->
                        <div class="px-6 pb-6 pt-2 flex items-center justify-between mt-auto">
                            <div>
                                <span class="text-xs text-gray-400 block uppercase tracking-wider">Tarif</span>
                                <span class="text-2xl font-extrabold text-gray-900">{{ number_format($training->price, 2, ',', ' ') }}€</span>
                            </div>
                            <a href="{{ route('training-calendar.index', ['training' => $training->id]) }}"
                               class="px-5 py-2.5 rounded-full font-semibold text-sm transition-all shadow-sm {{ $btnBg }}">
                                Réserver
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
