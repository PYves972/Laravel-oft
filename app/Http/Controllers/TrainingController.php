<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Category;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with(['category', 'tags', 'sessions'])
            ->where('is_active', true)
            ->get();

        return view('trainings.index', compact('trainings'));
    }

    public function show($slug)
    {
        $training = Training::with(['category', 'tags', 'sessions'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('trainings.show', compact('training'));
    }
}
