<div class="max-w-7xl mx-auto py-8 px-4">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    <!-- Messages Flash -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 text-sm text-rose-800 bg-rose-50 rounded-xl border border-rose-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filtres d'ateliers/formations -->
    <div class="mb-6 flex flex-wrap gap-2">
        <button
            wire:click="filterByTraining(null)"
            class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ is_null($selectedTrainingId) ? 'bg-[#2D3B22] text-white shadow' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
            Tous les créneaux
        </button>
        @foreach($trainings as $training)
            <button
                wire:click="filterByTraining({{ $training->id }})"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ $selectedTrainingId == $training->id ? 'bg-[#2D3B22] text-white shadow' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                {{ $training->title }}
            </button>
        @endforeach
    </div>

    <!-- Calendrier -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200">
        <div id="calendar" wire:ignore></div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', initCalendar);
        document.addEventListener('DOMContentLoaded', initCalendar);

        function initCalendar() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                hiddenDays: [0, 1], // Masque le Dimanche (0) et le Lundi (1)
                dayMaxEvents: 3,    // Condense l'affichage à 3 éléments max par jour
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semaine'
                },
                events: @json($events),
                eventClick: function(info) {
                    if (confirm('Voulez-vous réserver la session "' + info.event.title + '" ?')) {
                        @this.call('bookSession', info.event.id);
                    }
                }
            });

            calendar.render();
        }
    </script>
</div>
