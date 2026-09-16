<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Training;
use App\Models\TrainingSession;
use Carbon\Carbon;
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

    public function addToCart()
    {
        // 1. Rediriger si l'utilisateur n'est pas connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Vérifier qu'une session est sélectionnée
        if (!$this->selectedSessionId) {
            return;
        }

        $session = TrainingSession::findOrFail($this->selectedSessionId);

        // 3. Empêcher les doublons de réservation
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('training_session_id', $session->id)
            ->first();

        if ($existingBooking) {
            session()->flash('message', 'Vous avez déjà réservé ce créneau !');
            return;
        }

        // 4. Créer l'enregistrement en base de données
        Booking::create([
            'user_id'             => Auth::id(),
            'training_session_id' => $session->id,
            'status'              => 'confirmed', // Ajustez selon vos statuts (ex: pending, confirmed)
            'price'               => $this->training->price ?? 0,
        ]);

        // 5. Réinitialiser la sélection et afficher le message de confirmation
        $this->selectedSessionId = null;
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
