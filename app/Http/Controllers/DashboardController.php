<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PedagogicalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    /** @var \App\Models\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();

    // 1. Récupérer les réservations avec leurs relations
    $bookings = Booking::with(['trainingSession.training'])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    // 2. Extraire la liste des IDs de formations
    $trainingIds = $bookings->pluck('trainingSession.training_id')->filter()->unique();

    // 3. Récupérer les documents associés
    $documents = PedagogicalDocument::whereIn('training_id', $trainingIds)
        ->where('is_public', true)
        ->get();

    return view('dashboard', compact('bookings', 'documents'));
}
}
