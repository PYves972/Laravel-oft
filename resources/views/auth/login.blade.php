<x-guest-layout>
    <div class="text-center">
        <p class="text-xs font-medium uppercase tracking-luxe text-gold">
            Bienvenue
        </p>

        <h1 class="mt-3 font-serif text-3xl font-semibold tracking-tight text-ink">
            Connexion
        </h1>

        <p class="mt-3 text-sm leading-6 text-ink/60">
            Accédez à votre espace Oft Atelier.
        </p>
    </div>

    <div class="my-8 h-px bg-gold/20"></div>

    <x-auth-session-status
        class="mb-6"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
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

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <x-input-label
                    for="password"
                    value="Mot de passe"
                    class="!text-sm !font-medium !text-ink"
                />

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-xs font-medium text-burgundy transition hover:text-ochre"
                    >
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-lg border border-gold/30 bg-cream px-4 py-3 text-sm text-ink shadow-none transition placeholder:text-ink/30 focus:border-ochre focus:ring-1 focus:ring-ochre"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        {{-- Remember me --}}
        <div>
            <label
                for="remember_me"
                class="inline-flex cursor-pointer items-center"
            >
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-gold/40 text-ochre shadow-sm focus:ring-ochre"
                >

                <span class="ms-2 text-sm text-ink/60">
                    Se souvenir de moi
                </span>
            </label>
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button
                type="submit"
                class="w-full rounded-lg bg-ochre px-6 py-3.5 text-sm font-semibold uppercase tracking-luxe text-white shadow-sm transition duration-200 hover:bg-gold focus:outline-none focus:ring-2 focus:ring-ochre focus:ring-offset-2 focus:ring-offset-cream"
            >
                Se connecter
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="mt-8 text-center">
            <p class="text-sm text-ink/60">
                Vous n'avez pas encore de compte ?
                <a
                    href="{{ route('register') }}"
                    class="font-medium text-burgundy transition hover:text-ochre"
                >
                    Créer un compte
                </a>
            </p>
        </div>
    @endif
</x-guest-layout>
