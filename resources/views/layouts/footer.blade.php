<footer class="bg-[#2D3B22] text-[#F9F8F3] pt-16 pb-12">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-white/10">
            <!-- Brand -->
            <div class="space-y-4 md:col-span-1">
                <h3 class="font-serif text-2xl font-bold tracking-tight text-white">Ô fil du temps</h3>
                <p class="text-sm text-gray-300 leading-relaxed">
                    Atelier de couture, cours, formations et créations sur mesure. L'art de transmettre la passion du fil et du tissu.
                </p>
            </div>

            <!-- Navigation rapide -->
            <div class="space-y-3">
                <h4 class="text-base font-semibold uppercase tracking-wider text-white">Navigation</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="{{ url('/') }}#accueil" class="hover:text-white transition">Accueil</a></li>
                    <li><a href="{{ url('/') }}#a-propos" class="hover:text-white transition">À propos</a></li>
                    <li><a href="{{ url('/') }}#services" class="hover:text-white transition">Ateliers et formations</a></li>
                    <li><a href="{{ url('/') }}#temoignages" class="hover:text-white transition">Témoignages</a></li>
                    <li><a href="{{ url('/') }}#contact" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <!-- Horaires -->
            <div class="space-y-3">
                <h4 class="text-base font-semibold uppercase tracking-wider text-white">Horaires</h4>
                <p class="text-sm text-gray-300 leading-relaxed">
                    Mardi — Samedi<br>
                    09h00 – 18h00<br><br>
                    Fermé le dimanche et lundi.
                </p>
            </div>

            <!-- Contact -->
            <div class="space-y-3">
                <h4 class="text-base font-semibold uppercase tracking-wider text-white">Contact</h4>
                <p class="text-sm text-gray-300 leading-relaxed">
                    +596 696 92 62 64<br>
                    oftcreation@gmail.com<br>
                    Quartier Ermitage Gonnier, Saint-Joseph
                </p>
            </div>
        </div>

        <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-400 gap-4">
            <p>&copy; {{ date('Y') }} Ô fil du temps. Tous droits réservés.</p>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">Mentions légales</a>
                <a href="#" class="hover:text-white transition">Politique de confidentialité</a>
            </div>
        </div>
    </div>
</footer>
