<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PedagogicalDocument;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

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

        // 4. Définition des indicateurs clés (KPIs) avec "Documents"
        $kpis = [
            [
                'label' => 'Réservations',
                'value' => $bookings->count(),
                'icon'  => '📅',
            ],
            [
                'label' => 'Documents',
                'value' => $documents->count(),
                'icon'  => '📁',
            ],
            [
                'label' => 'Nouveaux messages',
                'value' => 0, // À adapter selon votre modèle de messages
                'icon'  => '✉️',
            ],
            [
                'label' => 'Ateliers actifs',
                'value' => Training::count(), // Compte les ateliers disponibles
                'icon'  => '🎨',
            ],
        ];

        // 5. Transmission de toutes les variables à la vue
        return view('dashboard', [
            'bookings'       => $bookings,
            'recentBookings' => $bookings->take(5), // 5 dernières réservations pour le tableau
            'documents'      => $documents,
            'kpis'           => $kpis,
        ]);
    }
}