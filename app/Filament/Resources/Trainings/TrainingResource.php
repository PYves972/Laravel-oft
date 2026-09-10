<?php

namespace App\Filament\Resources\Trainings;

use App\Models\Training;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;


class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationLabel = 'Gestion des Ateliers';

    protected static ?int $navigationSort = 2;

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-academic-cap';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Atelier')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Places')
                    ->formatStateUsing(fn ($record) => "{$record->booked_seats}/{$record->total_seats}"),

                Tables\Columns\TextColumn::make('booked_seats')
                    ->label('Réservations')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Disponible' => 'success',
                        'Complet' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Tous les statuts')
                    ->options([
                        'Disponible' => 'Disponible',
                        'Complet' => 'Complet',
                    ]),
            ], layout: FiltersLayout::AboveContent)
            ->headerActions([
                CreateAction::make()
                    ->label('+ Nouvel atelier')
                    ->button(),
            ])
            ->actions([
                EditAction::make()
                    ->iconButton()
                    ->icon('heroicon-o-pencil-square')
                    ->color('info'),
                DeleteAction::make()
                    ->iconButton()
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ]);
    }
}
