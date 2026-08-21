<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalogue des Formations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($trainings as $training)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-between p-6">
                        <div>
                            <span class="text-xs font-semibold uppercase px-2 py-1 bg-indigo-100 text-indigo-800 rounded">
                                {{ $training->category->name }}
                            </span>

                            <h3 class="text-xl font-bold text-gray-900 mt-2">
                                <a href="{{ route('trainings.show', $training->slug) }}" class="hover:underline">
                                    {{ $training->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                                {{ $training->description }}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-1">
                                @foreach($training->tags as $tag)
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($training->price, 2) }} €</span>
                                <span class="text-xs text-gray-500 block">{{ $training->duration_minutes }} min</span>
                            </div>

                            <a href="{{ route('trainings.show', $training->slug) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Voir la fiche
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
