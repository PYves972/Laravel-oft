<x-guest-layout>
    <div class="text-center">
        <p class="text-xs font-medium uppercase tracking-luxe text-gold">
            Sécurité
        </p>

        <h1 class="mt-3 font-serif text-3xl font-semibold tracking-tight text-ink">
            Mot de passe oublié
        </h1>

        <p class="mt-3 text-sm leading-6 text-ink/60">
            Indiquez votre adresse email et nous vous enverrons un lien
            pour réinitialiser votre mot de passe.
        </p>
    </div>

    <div class="my-8 h-px bg-gold/20"></div>

    <x-auth-session-status
        class="mb-6"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

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
                autofocus
                autocomplete="username"
                placeholder="vous@exemple.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button
                type="submit"
                class="w-full rounded-lg bg-ochre px-6 py-3.5 text-sm font-semibold uppercase tracking-luxe text-white shadow-sm transition duration-200 hover:bg-gold focus:outline-none focus:ring-2 focus:ring-ochre focus:ring-offset-2 focus:ring-offset-cream"
            >
                Envoyer le lien
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <a
            href="{{ route('login') }}"
            class="text-sm font-medium text-burgundy transition hover:text-ochre"
        >
            Retour à la connexion
        </a>
    </div>
</x-guest-layout>
