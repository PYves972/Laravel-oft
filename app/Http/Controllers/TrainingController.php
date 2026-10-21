<?php

namespace App\Http\Controllers;

use App\Models\Training;

class TrainingController extends Controller
{
    /**
     * Affiche la page "Nos Formations de Couture" (/formations)
     */
    public function formations()
    {
        $trainings = Training::with('category')
            ->where('is_active', true)
            ->whereIn('type', ['formation', 'Formation'])
            ->orderBy('title')
            ->get();

        return view('trainings.formations', compact('trainings'));
    }

    /**
     * Affiche la page "Nos Ateliers Créatifs" (/ateliers)
     */
    public function workshops()
    {
        $trainings = Training::with('category')
            ->where('is_active', true)
            ->whereIn('type', ['atelier', 'Atelier', 'workshop', 'Workshop'])
            ->orderBy('title')
            ->get();

        return view('trainings.workshops', compact('trainings'));
    }

    /**
     * Affiche la fiche détaillée d'un atelier ou d'une formation actif(ve)
     */
    public function show($slug)
    {
        $training = Training::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Seuls les commentaires approuvés sont publics
        $comments = $training->comments()
            ->approved()
            ->with('user')
            ->latest()
            ->get();

        return view('trainings.show', compact('training', 'comments'));
    }
}
