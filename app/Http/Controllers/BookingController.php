<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TrainingSession;
use App\Services\BookingService;
use DomainException;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Enregistrer une réservation.
     */
    public function store(TrainingSession $session, BookingService $bookings)
    {
        try {
            $bookings->book(Auth::user(), $session->id);
        } catch (DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('dashboard')
            ->with('success', 'Votre réservation a été enregistrée avec succès !');
    }

    /**
     * Annuler une réservation.
     */
    public function cancel($id, BookingService $bookings)
    {
        // Seul le propriétaire de la réservation peut l'annuler
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $bookings->cancel($booking);

        return back()->with('success', 'Votre réservation a été annulée avec succès.');
    }

    /**
     * Alternative courante REST (destroy).
     */
    public function destroy($id, BookingService $bookings)
    {
        return $this->cancel($id, $bookings);
    }
}
