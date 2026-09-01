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
    public function store(Request $request)
    {
        $request->validate([
            'training_session_id' => 'required|exists:training_sessions,id',
        ]);

        $session = TrainingSession::findOrFail($request->training_session_id);

        // 1. Vérification des places disponibles
        $placesRestantes = $session->available_places ?? $session->places_restantes ?? 0;

        if ($placesRestantes <= 0) {
            return back()->with('error', 'Désolé, cette session est déjà complète.');
        }

        // 2. Vérification pour éviter les doublons de réservation
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('training_session_id', $session->id)
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Vous êtes déjà inscrit à cette session.');
        }

        // 3. Création de la réservation
        Booking::create([
            'user_id' => Auth::id(),
            'training_session_id' => $session->id,
            'status' => 'confirmed',
        ]);

        // 4. Décrémenter le nombre de places restantes
        if (isset($session->available_places)) {
            $session->decrement('available_places');
        } elseif (isset($session->places_restantes)) {
            $session->decrement('places_restantes');
        }

        return back()->with('success', 'Votre réservation a bien été enregistrée !');
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
