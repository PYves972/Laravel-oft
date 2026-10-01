<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\PedagogicalDocument;
use App\Models\Training;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // Définit la position en tout premier (tout en haut)
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('TOTAL', '34.560 €')
                ->description('Chiffre global')
                ->color('danger')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('DOCUMENTS', PedagogicalDocument::count())
                ->description('Fichiers disponibles')
                ->color('warning')
                ->icon('heroicon-o-document-text'),

            Stat::make('RÉSERVATIONS', Booking::count())
                ->description('Inscriptions actives')
                ->color('success')
                ->icon('heroicon-o-user-group'),

            Stat::make('ATELIERS', Training::count())
                ->description('Ateliers au catalogue')
                ->color('info')
                ->icon('heroicon-o-academic-cap'),
        ];
    }
}