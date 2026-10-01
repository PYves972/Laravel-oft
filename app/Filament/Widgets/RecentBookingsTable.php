<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookingsTable extends BaseWidget
{
    protected static ?int $sort = 2; 
    protected int | string | array $columnSpan = 'full'; 

    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Client')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('trainingSession.training.title')
                    ->label('Atelier')
                    ->badge()
                    ->color('primary'), // Applique la couleur orange/terracotta au badge

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Date d\'inscription'),
            ])
            ->heading('Dernières Réservations')
            ->paginated(false); // Désactive la pagination si vous souhaitez un aperçu compact de 5 lignes
    }
}