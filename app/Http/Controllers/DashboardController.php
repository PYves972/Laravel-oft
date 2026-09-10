<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PedagogicalDocument;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupérer les réservations à venir de l'utilisateur
        $bookings = Booking::with(['trainingSession.training'])
            ->where('user_id', $user->id)
            ->get();

        // Récupérer les identifiants des formations réservées
        $trainingIds = $bookings->pluck('trainingSession.training_id')->unique();

        // Récupérer les documents pédagogiques associés
        $documents = PedagogicalDocument::whereIn('training_id', $trainingIds)
            ->where('is_public', true)
            ->get();

        return view('dashboard', compact('bookings', 'documents'));
    }
}
