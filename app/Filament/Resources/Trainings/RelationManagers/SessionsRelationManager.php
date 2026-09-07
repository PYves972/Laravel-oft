<?php

namespace App\Filament\Resources\Trainings\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessions';

    protected static ?string $title = 'Créneaux & Dates de l\'atelier';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('starts_at')
                    ->label('Début de session')
                    ->required()
                    ->native(false)
                    ->seconds(false),

                DateTimePicker::make('ends_at')
                    ->label('Fin de session')
                    ->required()
                    ->native(false)
                    ->seconds(false),

                TextInput::make('capacity')
                    ->label('Places disponibles')
                    ->numeric()
                    ->default(6)
                    ->required(),

                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'open' => 'Ouvert',
                        'cancelled' => 'Annulé',
                        'completed' => 'Terminé',
                    ])
                    ->default('open')
                    ->required()
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('starts_at')
            ->columns([
                TextColumn::make('starts_at')
                    ->label('Début')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('ends_at')
                    ->label('Fin')
                    ->dateTime('H:i')
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('Capacité'),

                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'gray',
                        default => 'gray',
                    }),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Ajouter un créneau'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
