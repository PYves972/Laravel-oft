<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Affiche la page "Nos Formations de Couture" (/formations)
     */
    public function formations()
    {
        $trainings = Training::whereIn('type', ['formation', 'Formation'])->get();

        if ($trainings->isEmpty()) {
            $trainings = Training::all();
        }

        return view('trainings.formations', compact('trainings'));
    }

    /**
     * Affiche la page "Nos Ateliers Créatifs" (/ateliers)
     */
    public function workshops()
    {
        $trainings = Training::whereIn('type', ['atelier', 'Atelier', 'workshop', 'Workshop'])->get();

        if ($trainings->isEmpty()) {
            $trainings = Training::all();
        }

        return view('trainings.workshops', compact('trainings'));
    }

    /**
     * Affiche la fiche détaillée d'un atelier ou d'une formation
     */
public function show($slug)
{
    $training = Training::where('slug', $slug)->firstOrFail();

    return view('trainings.show', compact('training'));
}
}
