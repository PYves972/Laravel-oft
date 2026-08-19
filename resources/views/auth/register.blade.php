<x-guest-layout>
    <div class="text-center">
        <p class="text-xs font-medium uppercase tracking-luxe text-gold">
            Bienvenue
        </p>

        <h1 class="mt-3 font-serif text-3xl font-semibold tracking-tight text-ink">
            Créer un compte
        </h1>

        <p class="mt-3 text-sm leading-6 text-ink/60">
            Rejoignez l'univers Oft Atelier.
        </p>
    </div>

    <div class="my-8 h-px bg-gold/20"></div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label
                for="name"
                value="Nom"
                class="!text-sm !font-medium !text-ink"
            />

            <x-text-input
                id="name"
                class="mt-2 block w-full rounded-lg border border-gold/30 bg-cream px-4 py-3 text-sm text-ink shadow-none transition placeholder:text-ink/30 focus:border-ochre focus:ring-1 focus:ring-ochre"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="Votre nom"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label
                for="email"
                value="Adresse email"
                class="!text-sm !font-medium !text-ink"
            />

            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-lg border border-gold/30 bg-cream px-4 py-3 text-sm text-ink shadow-none transition placeholder:text-ink/30 focus:border-ochre focus:ring-1 focus:ring-ochre"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="vous@exemple.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label
                for="password"
                value="Mot de passe"
                class="!text-sm !font-medium !text-ink"
            />

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-lg border border-gold/30 bg-cream px-4 py-3 text-sm text-ink shadow-none transition placeholder:text-ink/30 focus:border-ochre focus:ring-1 focus:ring-ochre"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        {{-- Confirm password --}}
        <div>
            <x-input-label
                for="password_confirmation"
                value="Confirmer le mot de passe"
                class="!text-sm !font-medium !text-ink"
            />

            <x-text-input
                id="password_confirmation"
                class="mt-2 block w-full rounded-lg border border-gold/30 bg-cream px-4 py-3 text-sm text-ink shadow-none transition placeholder:text-ink/30 focus:border-ochre focus:ring-1 focus:ring-ochre"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button
                type="submit"
                class="w-full rounded-lg bg-ochre px-6 py-3.5 text-sm font-semibold uppercase tracking-luxe text-white shadow-sm transition duration-200 hover:bg-gold focus:outline-none focus:ring-2 focus:ring-ochre focus:ring-offset-2 focus:ring-offset-cream"
            >
                Créer mon compte
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-sm text-ink/60">
            Vous avez déjà un compte ?
            <a
                href="{{ route('login') }}"
                class="font-medium text-burgundy transition hover:text-ochre"
            >
                Se connecter
            </a>
        </p>
    </div>
</x-guest-layout>
