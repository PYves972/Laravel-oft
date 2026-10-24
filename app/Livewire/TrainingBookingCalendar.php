<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingSession;
use App\Services\BookingService;
use DomainException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TrainingBookingCalendar extends Component
{
    public $selectedTrainingId = null;

    public function mount()
    {
        if (request()->has('training')) {
            $this->selectedTrainingId = request()->get('training');
        }
    }

    public function filterByTraining($trainingId = null)
    {
        $this->selectedTrainingId = $trainingId;
    }

    public function bookSession($sessionId, BookingService $bookings)
    {
        if (! Auth::check()) {
            session()->flash('error', 'Vous devez être connecté pour réserver.');
            return redirect()->route('login');
        }

        try {
            $bookings->book(Auth::user(), (int) $sessionId);
        } catch (DomainException $e) {
            session()->flash('error', $e->getMessage());
            return;
        }

        session()->flash('success', 'Votre réservation a été enregistrée avec succès !');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        // Seuls les ateliers actifs sont proposés
        $trainings = Training::where('is_active', true)->orderBy('title')->get();

        $sessionsQuery = TrainingSession::with('training')
            ->where('starts_at', '>=', now())
            ->whereHas('training', fn ($q) => $q->where('is_active', true));

        if ($this->selectedTrainingId) {
            $sessionsQuery->where('training_id', $this->selectedTrainingId);
        }

        $sessions = $sessionsQuery->orderBy('starts_at', 'asc')->get();

        $events = $sessions->map(function ($session) {
            return [
                'id'    => $session->id,
                'title' => $session->training?->title ?? $session->title,
                'start' => $session->starts_at?->toIso8601String(),
                'end'   => $session->ends_at?->toIso8601String(),
                'color' => $session->training?->color ?? '#2D3B22',
            ];
        })->toArray();

        return view('livewire.training-booking-calendar', [
            'trainings' => $trainings,
            'events'    => $events,
        ]);
    }
}
