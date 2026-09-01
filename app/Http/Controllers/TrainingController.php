<?php

namespace App\Models;

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrainingController extends Controller
{
    /**
     * Affiche le catalogue complet des formations.
     */
    public function index(): View
    {
        $trainings = Training::with(['category'])
            ->where('is_active', true)
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
            'sessions' => function ($query) {
                $query
                    ->withCount([
                        'bookings as confirmed_bookings_count' => function ($bookingQuery) {
                            $bookingQuery->where('status', 'confirmed');
                        },
                    ])
                    ->when(Auth::check(), function ($query) {
                        $query->with([
                            'bookings' => function ($bookingQuery) {
                                $bookingQuery->where('user_id', Auth::id());
                            },
                        ]);
                    })
                    ->where('status', 'open')
                    ->where('starts_at', '>=', now())
                    ->orderBy('starts_at');
            },
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('trainings.show', compact('training'));
    }
}
