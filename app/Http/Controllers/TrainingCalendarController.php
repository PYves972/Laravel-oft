<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingCalendarController extends Controller
{
    /**
     * Affiche le calendrier hebdomadaire des ateliers avec navigation.
     */
    public function index(Request $request): View
    {
        // 1. Récupération de la date passée en paramètre ou date du jour
        $requestedDate = $request->input('week')
            ? Carbon::parse($request->input('week'))
            : Carbon::now();

        // 2. Définition du lundi de la semaine ciblée
        $startOfWeek = $requestedDate->copy()->startOfWeek(Carbon::MONDAY);

        // 3. Génération des jours affichés (Mardi au Samedi)
        $days = collect(range(1, 5))->map(function ($dayOffset) use ($startOfWeek) {
            return $startOfWeek->copy()->addDays($dayOffset);
        });

        // 4. Plage de dates et récupération des séances groupées par jour
        $from = $days->first()->copy()->startOfDay();
        $to = $days->last()->copy()->endOfDay();

        $sessions = TrainingSession::with('training')
            ->whereBetween('starts_at', [$from, $to])
            ->orderBy('starts_at')
            ->get()
            ->groupBy(fn($session) => $session->starts_at->format('Y-m-d'));

        // 5. Dates de navigation (Semaine -1 / Semaine +1)
        $prevWeek = $startOfWeek->copy()->subWeek()->format('Y-m-d');
        $nextWeek = $startOfWeek->copy()->addWeek()->format('Y-m-d');

        return view('training-calendar.index', compact(
            'days',
            'sessions',
            'startOfWeek',
            'prevWeek',
            'nextWeek'
        ));
    }
}
