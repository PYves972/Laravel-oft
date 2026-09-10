<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Enregistrer une réservation.
     */
public function store(Request $request, $sessionId)
{
    $user = auth()->user();

    // Vérifier si la réservation existe déjà
    $existingBooking = Booking::where('user_id', $user->id)
        ->where('training_session_id', $sessionId)
        ->first();

    if ($existingBooking) {
        return back()->with('error', 'Vous êtes déjà inscrit à cette session.');
    }

    // Création de la réservation
    Booking::create([
        'user_id' => $user->id,
        'training_session_id' => $sessionId,
        'status' => 'confirmed', // Ajustez selon vos statuts
    ]);

    return redirect()->route('dashboard')->with('success', 'Votre réservation a été enregistrée avec succès !');
}

    /**
     * Annuler une réservation.
     */
    public function cancel($id)
    {
        // Récupérer la réservation appartenant à l'utilisateur connecté
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $session = TrainingSession::find($booking->training_session_id);

        // Supprimer la réservation
        $booking->delete();

        // Réaugmenter le nombre de places disponibles
        if ($session) {
            if (isset($session->available_places)) {
                $session->increment('available_places');
            } elseif (isset($session->places_restantes)) {
                $session->increment('places_restantes');
            }
        }

        return back()->with('success', 'Votre réservation a été annulée avec succès.');
    }

    /**
     * Alternative courante REST (destroy).
     */
    public function destroy($id)
    {
        return $this->cancel($id);
    }
}
