<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\View\View;

class TrainingCalendarController extends Controller
{
    /**
     * Affiche la page du calendrier des ateliers.
     */
    public function index(): View
    {
        // Récupère le premier cours actif en base de données
        $training = Training::where('is_active', true)->first() ?? Training::first();

        // Transmet la variable $training à la vue
        return view('training-calendar.index', compact('training'));
    }
}
