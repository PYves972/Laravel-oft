<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingSession;
use Carbon\Carbon;
use Livewire\Component;

class ShowAtelier extends Component
{
    public Training $training;
    public string $selectedMonth;
    public ?string $selectedDate = null;
    public ?int $selectedSessionId = null;

    public function mount(string $slug)
    {
        $this->training = Training::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $this->selectedMonth = Carbon::now()->format('Y-m-01');
    }

    public function selectDate(string $date)
    {
        $this->selectedDate = $date;
        $this->selectedSessionId = null;
    }

    public function selectSession(int $sessionId)
    {
        $this->selectedSessionId = $sessionId;
    }

public function addToCart()
    {
        if (!$this->selectedSessionId) {
            return;
        }

        // Message mis à jour pour la confirmation directe
        session()->flash('message', 'Votre réservation a été confirmée avec succès !');
    }

    public function render()
    {
        $sessions = TrainingSession::where('training_id', $this->training->id)
            ->where('status', 'open')
            ->where('starts_at', '>=', Carbon::now())
            ->get();

        $availableDates = $sessions->pluck('starts_at')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->unique()
            ->toArray();

        $selectedDateSessions = collect();
        if ($this->selectedDate) {
            $selectedDateSessions = $sessions->filter(function ($session) {
                return Carbon::parse($session->starts_at)->format('Y-m-d') === $this->selectedDate;
            });
        }

        return view('livewire.show-atelier', [
            'availableDates' => $availableDates,
            'sessionsForSelectedDate' => $selectedDateSessions,
        ]);
    }
}
