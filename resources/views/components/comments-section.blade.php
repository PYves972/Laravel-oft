@props(['training', 'comments'])

<div class="mt-8 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Avis et Commentaires</h3>

    <!-- Messages de succès / d'erreur -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire d'ajout de commentaire -->
    @auth
        <form action="{{ route('comments.store') }}" method="POST" class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
            @csrf
            <input type="hidden" name="training_id" value="{{ $training->id }}">

            <h4 class="text-lg font-semibold text-gray-700 mb-3">Laissez votre avis</h4>

            <!-- Sélection de la note (1 à 5) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Note :</label>
                <div class="flex items-center space-x-2">
                    <select name="rating" id="rating" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-gray-700">
                        <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5/5)</option>
                        <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4/5)</option>
                        <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3/5)</option>
                        <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2/5)</option>
                        <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐ (1/5)</option>
                    </select>
                </div>
            </div>

            <!-- Champ texte du commentaire -->
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Votre commentaire :</label>
                <textarea
                    name="content"
                    id="content"
                    rows="4"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                    placeholder="Qu'avez-vous pensé de cette formation ?"
                    required
                >{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors">
                Soumettre le commentaire
            </button>
        </form>
    @else
        <div class="mb-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800">
            Vous devez être <a href="{{ route('login') }}" class="underline font-semibold">connecté</a> pour laisser un commentaire.
        </div>
    @endauth

    <!-- Liste des commentaires approuvés -->
    <div class="space-y-4">
        <h4 class="text-xl font-semibold text-gray-800 border-b pb-2">Avis récents</h4>

        @forelse ($comments as $comment)
            <div class="p-4 bg-white border border-gray-100 rounded-lg shadow-2xs">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <span class="font-bold text-gray-800">{{ $comment->user->name ?? 'Utilisateur' }}</span>
                        <span class="text-xs text-gray-400">• {{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-amber-500">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $comment->rating)
                                ★
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor
                    </div>
                </div>
                <p class="text-gray-600">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-gray-500 italic py-4">Aucun avis pour le moment. Soyez le premier à donner votre avis !</p>
        @endforelse
    </div>
</div>
