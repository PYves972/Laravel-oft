<x-app-layout>
    <!-- pt-28 corrige le chevauchement avec la barre de navigation fixe -->
    <div class="pt-28 pb-12 bg-[#f4efe6] min-h-screen" x-data="{ activeTab: 'reservations' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- SIDEBAR / MENU GAUCHE -->
                <div class="md:col-span-1 bg-[#e8e1d5] p-6 rounded-2xl border border-[#d8cebe] shadow-sm flex flex-col items-center text-center h-fit">
                    <!-- Avatar -->
                    <div class="w-20 h-20 bg-[#d1a153] rounded-full flex items-center justify-center text-white mb-3">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>

                    <!-- Nom & Rôle -->
                    <h2 class="font-serif font-bold text-lg text-[#333]">{{ auth()->user()->name }}</h2>
                    <span class="w-full bg-[#d6ccbc] text-[#555] text-xs font-medium py-1 px-3 rounded-full mt-1 mb-6">
                        Membre
                    </span>

                    <!-- Navigation des Onglets -->
                    <nav class="w-full space-y-2 text-left">
                        <button @click="activeTab = 'profil'"
                                :class="activeTab === 'profil' ? 'bg-[#5e6d53] text-white' : 'text-[#444] hover:bg-[#ded5c5]'"
                                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition">
                            📋 <span>Mon profil</span>
                        </button>

                        <button @click="activeTab = 'reservations'"
                                :class="activeTab === 'reservations' ? 'bg-[#5e6d53] text-white' : 'text-[#444] hover:bg-[#ded5c5]'"
                                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition">
                            📅 <span>Mes réservations</span>
                        </button>

                        <button @click="activeTab = 'progression'"
                                :class="activeTab === 'progression' ? 'bg-[#5e6d53] text-white' : 'text-[#444] hover:bg-[#ded5c5]'"
                                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition">
                            📈 <span>Ma progression</span>
                        </button>

                        <button @click="activeTab = 'documents'"
                                :class="activeTab === 'documents' ? 'bg-[#5e6d53] text-white' : 'text-[#444] hover:bg-[#ded5c5]'"
                                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition">
                            📚 <span>Mes documents</span>
                        </button>
                    </nav>
                </div>

                <!-- CONTENU PRINCIPAL (DROITE) -->
                <div class="md:col-span-3">

                    <!-- ONGLET : MON PROFIL -->
                    <div x-show="activeTab === 'profil'" class="bg-[#e8e1d5] p-6 rounded-2xl border border-[#d8cebe] shadow-sm relative">
                        <div class="flex justify-between items-start mb-6">
                            <h2 class="font-serif font-bold text-2xl text-[#222]">Mon profil</h2>
                            <a href="{{ route('profile.edit') }}" class="px-4 py-1.5 bg-[#5e6d53] hover:bg-[#4d5a43] text-white text-sm font-medium rounded-lg transition">
                                Modifier
                            </a>
                        </div>

                        <div class="space-y-2 text-[#333] text-sm">
                            <p><strong class="font-semibold">Nom :</strong> {{ auth()->user()->name }}</p>
                            <p><strong class="font-semibold">Email :</strong> {{ auth()->user()->email }}</p>
                            <p><strong class="font-semibold">Téléphone :</strong> {{ auth()->user()->phone ?? 'Non renseigné' }}</p>
                            <p><strong class="font-semibold">Membre depuis :</strong> {{ auth()->user()->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <!-- ONGLET : MES RÉSERVATIONS -->
                    <div x-show="activeTab === 'reservations'" x-cloak class="bg-[#e8e1d5] p-6 rounded-2xl border border-[#d8cebe] shadow-sm">
                        <h2 class="font-serif font-bold text-2xl text-[#222] mb-6">Mes réservations</h2>

                        @forelse($bookings ?? [] as $booking)
                            <div class="bg-white p-4 rounded-xl border border-[#d8cebe] mb-3 flex items-center justify-between">
                                <div>
                                    <h3 class="font-bold text-[#333]">{{ $booking->trainingSession->training->title ?? 'Session' }}</h3>
                                    <!-- Format de date nettoyé avec format() explicite -->
                                    <p class="text-xs text-gray-500 mt-1">
                                        📅 {{ \Carbon\Carbon::parse($booking->trainingSession->start_time)->format('d/m/Y') }}
                                        de {{ \Carbon\Carbon::parse($booking->trainingSession->start_time)->format('H:i') }}
                                        à {{ \Carbon\Carbon::parse($booking->trainingSession->end_time)->format('H:i') }}
                                    </p>
                                </div>
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-rose-600 hover:underline font-medium">Annuler ma réservation</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600 italic">Vous n'avez aucune réservation à venir.</p>
                        @endforelse
                    </div>

                    <!-- ONGLET : MA PROGRESSION -->
                    <div x-show="activeTab === 'progression'" x-cloak class="bg-[#e8e1d5] p-6 rounded-2xl border border-[#d8cebe] shadow-sm">
                        <h2 class="font-serif font-bold text-2xl text-[#222] mb-4">Ma progression</h2>
                        <p class="text-sm text-gray-600">Suivi de vos compétences et ateliers complétés.</p>
                    </div>

                    <!-- ONGLET : MES DOCUMENTS -->
                    <div x-show="activeTab === 'documents'" x-cloak class="bg-[#e8e1d5] p-6 rounded-2xl border border-[#d8cebe] shadow-sm">
                        <h2 class="font-serif font-bold text-2xl text-[#222] mb-6">Mes documents pédagogiques</h2>

                        @forelse($documents ?? [] as $doc)
                            <div class="bg-white p-4 rounded-xl border border-[#d8cebe] mb-3 flex items-center justify-between">
                                <div>
                                    <h3 class="font-bold text-[#333]">{{ $doc->title }}</h3>
                                    <p class="text-xs text-gray-500">Formation : {{ $doc->training->title ?? 'N/A' }}</p>
                                </div>
                                <a href="{{ route('documents.download', $doc) }}" class="px-3 py-1.5 bg-[#5e6d53] hover:bg-[#4d5a43] text-white text-xs font-medium rounded-lg transition">
                                    Télécharger
                                </a>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600 italic">Aucun document téléchargeable disponible.</p>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
