<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, TrainingSession $session)
    {
        // 1. Vérifier si la session est complète
        if (!$session->hasAvailableSeats()) {
            return back()->with('error', 'Désolé, cette session est déjà complète.');
        }

        // 2. Vérifier si l'utilisateur est déjà inscrit
        $alreadyBooked = Booking::where('user_id', Auth::id())
            ->where('training_session_id', $session->id)
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Vous êtes déjà inscrit à cette séance.');
        }

        // 3. Créer la réservation
        Booking::create([
            'user_id' => Auth::id(),
            'training_session_id' => $session->id,
            'status' => 'confirmed',
        ]);

        // Mettre à jour le statut de la session si elle devient complète
        if (!$session->hasAvailableSeats()) {
            $session->update(['status' => 'full']);
        }

        return back()->with('success', 'Votre inscription à la séance a bien été enregistrée !');
    }
}
