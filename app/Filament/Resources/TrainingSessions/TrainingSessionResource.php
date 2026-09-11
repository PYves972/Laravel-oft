<?php

namespace App\Filament\Resources\TrainingSessions;

use App\Filament\Resources\TrainingSessions\Pages;
use App\Models\TrainingSession;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components;
use Filament\Actions;

class TrainingSessionResource extends Resource
{
    protected static ?string $model = TrainingSession::class;

    protected static ?string $modelLabel = 'Session / Créneau';

    protected static ?string $pluralModelLabel = 'Sessions de cours';

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion des Ateliers';
    }

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-calendar';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\Select::make('training_id')
                    ->relationship('training', 'title')
                    ->label('Atelier / Formation')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                Components\DateTimePicker::make('starts_at')
                    ->label('Début de la session')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y H:i'),

                Components\DateTimePicker::make('ends_at')
                    ->label('Fin de la session')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y H:i'),

                Components\TextInput::make('capacity')
                    ->label('Capacité max (places)')
                    ->numeric()
                    ->default(7)
                    ->required(),

                Components\Select::make('status')
                    ->label('Statut')
                    ->options([
                        'open' => 'Ouvert',
                        'full' => 'Complet',
                        'cancelled' => 'Annulé',
                    ])
                    ->default('open')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('training.title')
                    ->label('Atelier')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Date')
                    ->dateTime('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('starts_at_time')
                    ->label('Horaire')
                    ->state(fn ($record) => $record->starts_at->format('H\hi') . ' - ' . $record->ends_at->format('H\hi')),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacité')
                    ->numeric(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'full' => 'warning',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'Ouvert',
                        'full' => 'Complet',
                        'cancelled' => 'Annulé',
                    }),
            ])
            ->defaultSort('starts_at', 'asc')
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingSessions::route('/'),
            'create' => Pages\CreateTrainingSession::route('/create'),
            'edit' => Pages\EditTrainingSession::route('/{record}/edit'),
        ];
    }
}
