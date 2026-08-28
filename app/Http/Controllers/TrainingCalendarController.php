<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Carbon\Carbon;
use Illuminate\View\View;

class TrainingCalendarController extends Controller
{
    /**
     * Affiche le calendrier hebdomadaire des ateliers.
     */
    public function index(): View
    {
        /*
         * Lundi de la semaine actuelle.
         */
        $monday = Carbon::now()->startOfWeek(Carbon::MONDAY);

        /*
         * Du mardi au samedi.
         */
        $days = collect([
            $monday->copy()->addDay(),
            $monday->copy()->addDays(2),
            $monday->copy()->addDays(3),
            $monday->copy()->addDays(4),
            $monday->copy()->addDays(5),
        ]);

        /*
         * Récupération des séances de la semaine.
         *
         * with('training') évite de faire une requête
         * supplémentaire pour chaque atelier.
         */
        $sessions = TrainingSession::with('training')
            ->whereBetween('starts_at', [
                $days->first()->copy()->startOfDay(),
                $days->last()->copy()->endOfDay(),
            ])
            ->orderBy('starts_at')
            ->get();

        return view('training-calendar.index', [
            'days' => $days,
            'sessions' => $sessions,
        ]);
    }
}
