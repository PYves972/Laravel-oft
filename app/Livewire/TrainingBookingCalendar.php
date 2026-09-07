<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TrainingBookingCalendar extends Component
{
    public $trainings;
    public $selectedTrainingId;
    public string $currentMonth;
    public ?string $selectedDate = null;
    public ?int $selectedSessionId = null;

    public function mount()
    {
        // 1. Initialise le mois courant (Ex: "2026-09")
        $this->currentMonth = now()->format('Y-m');

        // 2. Récupère toutes les formations/ateliers
        $this->trainings = Training::all();

        // 3. Capture l'ID passé dans l'URL (?training=X)
        $requestedTrainingId = request()->query('training');

        if ($requestedTrainingId && Training::where('id', $requestedTrainingId)->exists()) {
            $this->selectedTrainingId = (int) $requestedTrainingId;
        } else {
            $this->selectedTrainingId = $this->trainings->first()?->id;
        }

        // 4. Auto-sélectionne la première date disponible
        $this->autoSelectFirstDate();
    }

    // Réaction au changement d'option dans le menu déroulant
    public function updatedSelectedTrainingId()
    {
        $this->selectedDate = null;
        $this->selectedSessionId = null;
        $this->autoSelectFirstDate();
    }

    public function previousMonth()
    {
        $this->currentMonth = Carbon::createFromFormat('Y-m', $this->currentMonth)
            ->startOfMonth()
            ->subMonth()
            ->format('Y-m');

        $this->autoSelectFirstDate();
    }

    public function nextMonth()
    {
        $this->currentMonth = Carbon::createFromFormat('Y-m', $this->currentMonth)
            ->startOfMonth()
            ->addMonth()
            ->format('Y-m');

        $this->autoSelectFirstDate();
    }

    public function selectDate(string $date)
    {
        $this->selectedDate = $date;
        $session = $this->getSessionsQuery()->get()
            ->first(fn($s) => Carbon::parse($s->starts_at)->format('Y-m-d') === $date);

        $this->selectedSessionId = $session?->id;
    }

    public function bookSession(int $sessionId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $session = TrainingSession::findOrFail($sessionId);

        Booking::firstOrCreate([
            'user_id' => Auth::id(),
            'training_session_id' => $session->id,
        ], [
            'status' => 'confirmed',
        ]);

        session()->flash('success', 'Votre réservation a été enregistrée !');

        return redirect()->route('dashboard');
    }

    private function getSessionsQuery()
    {
        $start = Carbon::createFromFormat('Y-m', $this->currentMonth)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $this->currentMonth)->endOfMonth();

        return TrainingSession::where('training_id', $this->selectedTrainingId)
            ->whereBetween('starts_at', [$start, $end])
            ->where('status', 'open')
            ->withCount(['bookings' => function ($query) {
                $query->where('status', 'confirmed');
            }]);
    }

    private function autoSelectFirstDate()
    {
        $firstSession = $this->getSessionsQuery()->first();
        if ($firstSession) {
            $this->selectedDate = Carbon::parse($firstSession->starts_at)->format('Y-m-d');
            $this->selectedSessionId = $firstSession->id;
        } else {
            $this->selectedDate = null;
            $this->selectedSessionId = null;
        }
    }

    public function render()
    {
        $dateObj = Carbon::createFromFormat('Y-m', $this->currentMonth)->locale('fr');
        $selectedTraining = Training::find($this->selectedTrainingId);

        $sessions = $this->getSessionsQuery()->get();
        $sessionsByDate = $sessions->groupBy(fn($item) => Carbon::parse($item->starts_at)->format('Y-m-d'));

        $startOfMonth = $dateObj->copy()->startOfMonth();
        $endOfMonth = $dateObj->copy()->endOfMonth();

        $calendarDays = [];
        $dayCursor = $startOfMonth->copy();

        while ($dayCursor->lte($endOfMonth)) {
            if (in_array($dayCursor->dayOfWeek, [2, 3, 4, 5, 6])) {
                $dateStr = $dayCursor->format('Y-m-d');
                $hasSession = $sessionsByDate->has($dateStr);

                $calendarDays[] = [
                    'date' => $dateStr,
                    'day_number' => $dayCursor->day,
                    'has_session' => $hasSession,
                    'is_disabled' => !$hasSession,
                ];
            }
            $dayCursor->addDay();
        }

        $selectedSessions = $this->selectedDate && isset($sessionsByDate[$this->selectedDate])
            ? $sessionsByDate[$this->selectedDate]
            : collect();

        return view('livewire.training-booking-calendar', [
            'monthLabel' => $dateObj->translatedFormat('F Y'),
            'selectedTraining' => $selectedTraining,
            'calendarDays' => $calendarDays,
            'selectedSessions' => $selectedSessions,
        ]);
    }
}
