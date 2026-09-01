<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrainingController extends Controller
{
    /**
     * Page dédiée aux Formations (Couture).
     */
    public function formations(): View
    {
        $trainings = Training::with(['category'])
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('slug', 'couture')
                      ->orWhere('name', 'LIKE', '%couture%');
            })
            ->get();

        return view('trainings.formations', compact('trainings'));
    }

    /**
     * Page dédiée aux Ateliers créatifs (Tricot, Crochet, Teinture, Broderie, Tissage).
     */
    public function workshops(): View
    {
        $trainings = Training::with(['category'])
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('slug', '!=', 'couture')
                      ->where('name', 'NOT LIKE', '%couture%');
            })
            ->get();

        return view('trainings.workshops', compact('trainings'));
    }

    /**
     * Affiche la fiche détaillée d'un atelier ou d'une formation.
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
