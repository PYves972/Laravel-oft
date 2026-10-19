<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\TrainingSession;
use App\Models\User;
use DomainException;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Réserve une place pour un membre sur une séance.
     *
     * @throws DomainException si la réservation n'est pas possible.
     */
    public function book(User $user, int $sessionId, ?int $trainingId = null): Booking
    {
        return DB::transaction(function () use ($user, $sessionId, $trainingId) {
            // Verrou sur la séance : deux réservations simultanées ne peuvent pas dépasser la capacité
            $session = TrainingSession::whereKey($sessionId)->lockForUpdate()->first();

            if (! $session) {
                throw new DomainException('Séance introuvable.');
            }

            if ($trainingId !== null && (int) $session->training_id !== $trainingId) {
                throw new DomainException('Cette séance ne correspond pas à cet atelier.');
            }

            if ($session->status !== 'open' || $session->starts_at->isPast()) {
                throw new DomainException("Cette séance n'est plus ouverte à la réservation.");
            }

            $alreadyBooked = Booking::where('user_id', $user->id)
                ->where('training_session_id', $session->id)
                ->exists();

            if ($alreadyBooked) {
                throw new DomainException('Vous avez déjà réservé cette séance.');
            }

            if ($session->placesLeft() <= 0) {
                throw new DomainException('Cette séance est complète.');
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'training_session_id' => $session->id,
                'status' => 'confirmed',
            ]);

            // La dernière place vient d'être prise : la séance passe à « complète »
            if ($session->placesLeft() <= 0) {
                $session->update(['status' => 'full']);
            }

            return $booking;
        });
    }

    /**
     * Annule une réservation et rouvre la séance si elle était complète.
     */
    public function cancel(Booking $booking): void
    {
        DB::transaction(function () use ($booking) {
            $session = TrainingSession::whereKey($booking->training_session_id)
                ->lockForUpdate()
                ->first();

            $booking->delete();

            if ($session && $session->status === 'full' && $session->starts_at->isFuture()) {
                $session->update(['status' => 'open']);
            }
        });
    }
}
