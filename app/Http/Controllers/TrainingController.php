<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function formations()
    {
        // Ne récupère QUE les formations (exclut les ateliers)
        $trainings = Training::where('type', 'formation')
            ->where('is_active', true)
            ->get();

        return view('trainings.formations', compact('trainings'));
    }

    public function workshops()
    {
        // Ne récupère QUE les ateliers (si 'type' n'est pas renseigné, on peut aussi filtrer par le nom de la catégorie si besoin)
        $trainings = Training::where('type', 'atelier')
            ->where('is_active', true)
            ->get();

        return view('trainings.workshops', compact('trainings'));
    }
}
