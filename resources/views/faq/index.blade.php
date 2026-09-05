<x-app-layout> {{-- Adaptez si votre layout s'appelle autrement, ex: <x-main-layout> --}}
    <div class="py-12 bg-stone-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">

            {{-- En-tête --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">En savoir plus sur l'atelier</h1>
                <p class="mt-4 text-lg text-gray-600">Retrouvez toutes les réponses à vos questions pour aborder votre séance sereinement.</p>
            </div>

            {{-- Accordéon FAQ par catégorie --}}
            <div class="space-y-10" x-data="{ openItem: null }">
                @foreach($faqs as $categoryIndex => $category)
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                            {{ $category['category'] }}
                        </h2>

                        <div class="space-y-3">
                            @foreach($category['items'] as $itemIndex => $item)
                                @php $id = $categoryIndex . '-' . $itemIndex; @endphp
                                <div class="border border-gray-200 rounded-xl bg-white shadow-sm overflow-hidden">
                                    <button
                                        @click="openItem = (openItem === '{{ $id }}' ? null : '{{ $id }}')"
                                        class="w-full p-5 text-left font-semibold text-gray-900 flex justify-between items-center focus:outline-none hover:bg-stone-50 transition"
                                    >
                                        <span>{{ $item['question'] }}</span>
                                        <svg class="w-5 h-5 text-amber-500 transform transition-transform duration-200"
                                             :class="{ 'rotate-180': openItem === '{{ $id }}' }"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="openItem === '{{ $id }}'" x-collapse class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-stone-100 pt-4">
                                        {{ $item['answer'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bloc d'aide si la question n'est pas dans la FAQ --}}
            <div class="mt-16 bg-amber-50 rounded-2xl p-8 text-center border border-amber-200">
                <h3 class="text-lg font-bold text-amber-900">Vous avez encore une question ?</h3>
                <p class="text-amber-700 text-sm mt-1">N'hésitez pas à nous contacter directement, nous vous répondrons rapidement.</p>
<a href="{{ route('home') }}#contact" class="inline-block mt-4 px-6 py-2.5 bg-amber-600 text-white font-medium rounded-lg shadow hover:bg-amber-700 transition">
    Nous contacter
</a>
            </div>

        </div>
    </div>
</x-app-layout>
