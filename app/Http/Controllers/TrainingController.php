<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrainingController extends Controller
{
    /**
     * Affiche le catalogue public des formations.
     */
    public function index(): View
    {
        $trainings = Training::with([
            'category',
            'tags',
        ])
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        return view('trainings.index', compact('trainings'));
    }

    /**
     * Affiche la fiche détaillée d'une formation.
     */
    public function show(string $slug): View
    {
        $training = Training::with([
            'category',
            'tags',

            /*
             * On récupère uniquement les séances :
             * - ouvertes
             * - à venir
             * - triées par date
             */
            'sessions' => function ($query) {

                $query
                    ->withCount([
                        /*
                         * Nombre de réservations confirmées
                         * pour chaque séance.
                         */
                        'bookings as confirmed_bookings_count' => function ($bookingQuery) {
                            $bookingQuery->where('status', 'confirmed');
                        },
                    ])

                    /*
                     * Si l'utilisateur est connecté,
                     * on récupère sa réservation éventuelle
                     * pour chaque séance.
                     */
                    ->when(Auth::check(), function ($query) {

                        $query->with([
                            'bookings' => function ($bookingQuery) {
                                $bookingQuery
                                    ->where('user_id', Auth::id());
                            },
                        ]);
                    })

                    /*
                     * Une séance annulée n'est pas affichée.
                     */
                    ->where('status', 'open')

                    /*
                     * On affiche uniquement les séances
                     * qui n'ont pas encore commencé.
                     */
                    ->where('start_at', '>=', now())

                    /*
                     * Les séances les plus proches en premier.
                     */
                    ->orderBy('start_at');
            },
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('trainings.show', compact('training'));
    }
}
