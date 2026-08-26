<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrainingController extends Controller
{
    /**
     * Affiche le calendrier des ateliers.
     */
    public function index(): View
    {
        // Semaine du mardi 1er au samedi 5 septembre 2026
        $startDate = now()->setDate(2026, 9, 1)->startOfDay();
        $endDate = now()->setDate(2026, 9, 5)->endOfDay();

        $days = collect();

        for (
            $date = $startDate->copy();
            $date->lte($endDate);
            $date->addDay()
        ) {
            $days->push($date->copy());
        }

        $sessions = TrainingSession::with([
            'training',
        ])
            ->withCount([
                'bookings as confirmed_bookings_count' => function ($query) {
                    $query->where('status', 'confirmed');
                },
            ])
            ->when(Auth::check(), function ($query) {
                $query->with([
                    'bookings' => function ($bookingQuery) {
                        $bookingQuery->where('user_id', Auth::id());
                    },
                ]);
            })
            ->whereIn('status', ['open', 'full'])
            ->whereBetween('start_at', [$startDate, $endDate])
            ->orderBy('start_at')
            ->get()
            ->each(function ($session) {
                $session->remaining_seats = max(
                    0,
                    $session->capacity_max
                    - $session->confirmed_bookings_count
                );

                $session->is_full = $session->remaining_seats === 0;

                $session->can_reserve = $session->remaining_seats > 0;

                $session->user_booking = $session->bookings->first();

                $session->is_reserved =
                    $session->user_booking
                    && $session->user_booking->status === 'confirmed';
            });

        return view('training-calendar.index', compact(
            'days',
            'sessions'
        ));
    }

    /**
     * Affiche la fiche détaillée d'une formation.
     */
    public function show(string $slug): View
    {
        $training = Training::with([
            'category',
            'tags',

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
                    ->where('start_at', '>=', now())
                    ->orderBy('start_at');
            },
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('trainings.show', compact('training'));
    }
}
