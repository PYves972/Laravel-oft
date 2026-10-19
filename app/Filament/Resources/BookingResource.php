<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion des Ateliers';
    }

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-ticket';
    }

    protected static ?string $navigationLabel = 'Réservations';
    protected static ?string $modelLabel = 'Réservation';
    protected static ?string $pluralModelLabel = 'Réservations';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Membre'),
                Select::make('training_session_id')
                    ->relationship('trainingSession', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => ($record->training?->title ?? 'Séance') . ' — ' . $record->starts_at->format('d/m/Y H:i'))
                    ->required()
                    ->label('Séance'),
                Select::make('status')
                    ->options([
                        'confirmed' => 'Confirmée',
                        'cancelled' => 'Annulée',
                    ])
                    ->default('confirmed')
                    ->required()
                    ->label('Statut'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Membre')->searchable(),
                Tables\Columns\TextColumn::make('trainingSession.training.title')->label('Atelier'),
                Tables\Columns\TextColumn::make('trainingSession.starts_at')->dateTime('d/m/Y H:i')->label('Séance'),
                Tables\Columns\TextColumn::make('status')->badge()->label('Statut'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Réservé le'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit'   => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
