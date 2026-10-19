<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\TrainingSession;
use App\Services\BookingService;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\Auth;
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

    public function addToCart(BookingService $bookings)
    {
        // 1. Rediriger si l'utilisateur n'est pas connecté
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Vérifier qu'une session est sélectionnée
        if (! $this->selectedSessionId) {
            return;
        }

        // 3. Les règles métier (séance ouverte, doublon, capacité) sont dans le service
        try {
            $bookings->book(Auth::user(), $this->selectedSessionId, $this->training->id);
        } catch (DomainException $e) {
            session()->flash('message', $e->getMessage());
            return;
        }

        // 4. Réinitialiser la sélection et afficher le message de confirmation
        $this->selectedSessionId = null;
        session()->flash('message', 'Votre réservation a été confirmée avec succès !');
    }

    public function render()
    {
        $sessions = TrainingSession::where('training_id', $this->training->id)
            ->where('status', 'open')
            ->where('starts_at', '>=', Carbon::now())
            ->withCount(['bookings as confirmed_bookings_count' => fn ($q) => $q->where('status', 'confirmed')])
            ->orderBy('starts_at')
            ->get();

        $availableDates = $sessions->pluck('starts_at')
            ->map(fn ($date) => Carbon::parse($date)->format('Y-m-d'))
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
