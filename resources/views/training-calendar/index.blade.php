<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        @if($training)
            @livewire('training-booking-calendar', ['training' => $training])
        @else
            <div class="text-center py-12 text-gray-500">
                Aucun cours disponible pour le moment.
            </div>
        @endif
    </div>
</x-app-layout>
