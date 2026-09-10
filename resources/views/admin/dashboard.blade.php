<x-app-layout>
    <div class="min-h-screen bg-[#f8fafc] flex" x-data="{ activeTab: 'overview' }">

        <!-- SIDEBAR SOMBRE (GAUCHE) -->
        <aside class="w-64 bg-[#1e293b] text-slate-300 flex flex-col shrink-0 min-h-screen">
            <!-- Logo & Marque -->
            <div class="p-6 text-center border-b border-slate-800">
                <span class="text-xs text-slate-400 uppercase tracking-widest block">Logo OFT</span>
                <h1 class="font-serif font-bold text-xl text-white mt-1">Admin OFT</h1>
            </div>

            <!-- Navigation des onglets -->
            <nav class="flex-1 p-4 space-y-2 text-sm font-medium">
                <button @click="activeTab = 'overview'"
                        :class="activeTab === 'overview' ? 'bg-[#d1a153] text-white font-semibold' : 'hover:bg-slate-800 text-slate-300'"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition">
                    📈 <span>Vue d'ensemble</span>
                </button>

                <button @click="activeTab = 'workshops'"
                        :class="activeTab === 'workshops' ? 'bg-[#d1a153] text-white font-semibold' : 'hover:bg-slate-800 text-slate-300'"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition">
                    🎨 <span>Gestion des Ateliers</span>
                </button>

                <button @click="activeTab = 'bookings'"
                        :class="activeTab === 'bookings' ? 'bg-[#d1a153] text-white font-semibold' : 'hover:bg-slate-800 text-slate-300'"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition">
                    📅 <span>Réservations</span>
                </button>

                <button @click="activeTab = 'users'"
                        :class="activeTab === 'users' ? 'bg-[#d1a153] text-white font-semibold' : 'hover:bg-slate-800 text-slate-300'"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition">
                    👥 <span>Utilisateurs</span>
                </button>

                <button @click="activeTab = 'messages'"
                        :class="activeTab === 'messages' ? 'bg-[#d1a153] text-white font-semibold' : 'hover:bg-slate-800 text-slate-300'"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition">
                    <div class="flex items-center gap-3">
                        ✉️ <span>Messages</span>
                    </div>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="bg-rose-500 text-white text-xs px-2 py-0.5 rounded-full font-bold">{{ $unreadMessagesCount }}</span>
                    @endif
                </button>
            </nav>

            <!-- Déconnexion -->
            <div class="p-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition text-sm">
                        🚪 <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTENU PRINCIPAL (DROITE) -->
        <main class="flex-1 p-8 overflow-y-auto">

            <!-- En-tête avec message de bienvenue -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-slate-800" x-text="
                    activeTab === 'overview' ? 'Tableau de bord' :
                    (activeTab === 'workshops' ? 'Gestion des ateliers' :
                    (activeTab === 'bookings' ? 'Gestion des réservations' :
                    (activeTab === 'users' ? 'Gestion des utilisateurs' : 'Messages')))
                "></h2>
                <div class="text-sm text-slate-500">
                    Bonjour, <strong class="text-slate-800">{{ auth()->user()->name }}</strong>
                </div>
            </div>

            <!-- 1. VUE D'ENSEMBLE -->
            <div x-show="activeTab === 'overview'" class="space-y-8">
                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#d1a153]/20 rounded-xl flex items-center justify-center text-[#d1a153] text-xl">📅</div>
                        <div>
                            <span class="text-xs text-slate-400 font-medium uppercase">Réservations</span>
                            <p class="text-2xl font-bold text-slate-800">{{ $stats['bookings'] ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#d1a153]/20 rounded-xl flex items-center justify-center text-[#d1a153] text-xl">💶</div>
                        <div>
                            <span class="text-xs text-slate-400 font-medium uppercase">Chiffre d'affaires</span>
                            <p class="text-2xl font-bold text-slate-800">{{ $stats['revenue'] ?? 0 }} €</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#d1a153]/20 rounded-xl flex items-center justify-center text-[#d1a153] text-xl">💬</div>
                        <div>
                            <span class="text-xs text-slate-400 font-medium uppercase">Nouveaux messages</span>
                            <p class="text-2xl font-bold text-slate-800">{{ $unreadMessagesCount ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#d1a153]/20 rounded-xl flex items-center justify-center text-[#d1a153] text-xl">🎨</div>
                        <div>
                            <span class="text-xs text-slate-400 font-medium uppercase">Ateliers actifs</span>
                            <p class="text-2xl font-bold text-slate-800">{{ $stats['activeWorkshops'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tableau Dernières réservations -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 text-lg mb-4">Dernières réservations</h3>
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-[#1e293b] text-white">
                                <th class="p-3 rounded-l-lg">Client</th>
                                <th class="p-3">Atelier</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Statut</th>
                                <th class="p-3 rounded-r-lg">Montant</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentBookings ?? [] as $booking)
                                <tr>
                                    <td class="p-3 font-medium">{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td class="p-3">{{ $booking->trainingSession->training->title ?? 'N/A' }}</td>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}</td>
                                    <td class="p-3">
                                        <span class="px-2.5 py-1 text-xs rounded-full bg-emerald-100 text-emerald-700 font-medium">Confirmé</span>
                                    </td>
                                    <td class="p-3 font-bold">{{ $booking->trainingSession->training->price ?? 0 }} €</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="p-4 text-center text-slate-400 italic">Aucune réservation récente.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. GESTION DES ATELIERS -->
            <div x-show="activeTab === 'workshops'" x-cloak class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-slate-800 text-lg">Liste des ateliers</h3>
                    <a href="{{ route('trainings.create') }}" class="px-4 py-2 bg-[#d1a153] hover:bg-[#b88c42] text-white rounded-xl text-sm font-semibold transition">
                        + Nouvel atelier
                    </a>
                </div>
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-[#1e293b] text-white">
                            <th class="p-3 rounded-l-lg">Atelier</th>
                            <th class="p-3">Prix</th>
                            <th class="p-3">Durée</th>
                            <th class="p-3 rounded-r-lg text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($workshops ?? [] as $workshop)
                            <tr>
                                <td class="p-3 font-medium">{{ $workshop->title }}</td>
                                <td class="p-3">{{ $workshop->price }} €</td>
                                <td class="p-3">{{ $workshop->duration }} h</td>
                                <td class="p-3 text-right">
                                    <a href="{{ route('trainings.edit', $workshop) }}" class="text-indigo-600 hover:underline mr-3">Éditer</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-4 text-center text-slate-400 italic">Aucun atelier.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 3. RÉSERVATIONS -->
            <div x-show="activeTab === 'bookings'" x-cloak class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 text-lg mb-4">Toutes les réservations</h3>
                <!-- Contenu table réservations -->
            </div>

            <!-- 4. UTILISATEURS -->
            <div x-show="activeTab === 'users'" x-cloak class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 text-lg mb-4">Gestion des utilisateurs</h3>
                <!-- Contenu table utilisateurs -->
            </div>

            <!-- 5. MESSAGES -->
            <div x-show="activeTab === 'messages'" x-cloak class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 text-lg mb-4">Messages reçus</h3>
                <!-- Liste des messages -->
            </div>

        </main>
    </div>
</x-app-layout>
