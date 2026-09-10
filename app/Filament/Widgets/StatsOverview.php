<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Training;
use App\Models\ContactMessage; // Si disponible
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4; // Force l'affichage sur 4 colonnes comme la maquette
    }

    protected function getStats(): array
    {
        // Calcul du CA
        $revenue = Booking::join('training_sessions', 'bookings.training_session_id', '=', 'training_sessions.id')
            ->join('trainings', 'training_sessions.training_id', '=', 'trainings.id')
            ->sum('trainings.price');

        return [
            Stat::make('Réservations', Booking::count())
                ->description('+0 cette semaine')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),

            Stat::make('Chiffre d\'affaires', number_format($revenue, 0, ',', ' ') . ' €')
                ->description('Mois en cours')
                ->color('success'),

            Stat::make('Nouveaux messages', 2) // À lier à votre modèle si existant
                ->description('Non lus')
                ->color('warning'),

            Stat::make('Ateliers actifs', Training::count())
                ->description('Ce mois')
                ->color('primary'),
        ];
    }
}
