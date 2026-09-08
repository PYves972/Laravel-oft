<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

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

    public function bookSession($sessionId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Vous devez être connecté pour réserver.');
            return redirect()->route('login');
        }

        $session = TrainingSession::find($sessionId);

        if (!$session) {
            session()->flash('error', 'Session introuvable.');
            return;
        }

        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('training_session_id', $sessionId)
            ->where('status', 'confirmed')
            ->first();

        if ($existingBooking) {
            session()->flash('error', 'Vous avez déjà réservé cette session.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'training_session_id' => $sessionId,
            'status' => 'confirmed',
        ]);

        session()->flash('success', 'Votre réservation a été enregistrée avec succès !');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $trainings = Training::all();

        $sessionsQuery = TrainingSession::with('training')
            ->where('starts_at', '>=', now());

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
