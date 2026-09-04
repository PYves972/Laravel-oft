<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

// Composants de formulaire
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

// Conteneurs de disposition / Layouts (Filament v5)
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-ticket';
    protected static \UnitEnum|string|null $navigationGroup = 'Gestion des Ateliers';

    protected static ?string $modelLabel = 'Réservation';
    protected static ?string $pluralModelLabel = 'Réservations';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Détails de la Réservation')
                ->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Client / Membre'),
                    Select::make('training_session_id')
                        ->relationship('trainingSession', 'id')
                        ->getOptionLabelFromRecordUsing(function ($record) {
                            $date = $record->starts_at instanceof Carbon
                                ? $record->starts_at->format('d/m/Y H:i')
                                : Carbon::parse($record->starts_at)->format('d/m/Y H:i');
                            return "{$record->training->title} — {$date}";
                        })
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Session d\'atelier'),
                    Select::make('status')
                        ->options([
                            'confirmed' => 'Confirmée',
                            'pending'   => 'En attente',
                            'cancelled' => 'Annulée',
                            'attended'  => 'Présent(e)',
                        ])
                        ->default('confirmed')
                        ->required()
                        ->label('Statut de la réservation'),
                    TextInput::make('seats')
                        ->numeric()
                        ->default(1)
                        ->minValue(1)
                        ->required()
                        ->label('Nombre de places réservées'),
                    Textarea::make('notes')
                        ->columnSpanFull()
                        ->label('Notes internes / Remarques'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('#'),
                TextColumn::make('user.name')->searchable()->sortable()->label('Membre'),
                TextColumn::make('user.email')->searchable()->toggleable(isToggledHiddenByDefault: true)->label('E-mail'),
                TextColumn::make('trainingSession.training.title')->searchable()->sortable()->label('Atelier'),
                TextColumn::make('trainingSession.starts_at')->dateTime('d/m/Y à H:i')->sortable()->label('Date & Heure'),
                TextColumn::make('seats')->sortable()->badge()->color('gray')->label('Places'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending'   => 'warning',
                        'cancelled' => 'danger',
                        'attended'  => 'info',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'confirmed' => 'Confirmée',
                        'pending'   => 'En attente',
                        'cancelled' => 'Annulée',
                        'attended'  => 'Présent(e)',
                        default     => $state,
                    })
                    ->label('Statut'),
                TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true)->label('Réservé le'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'confirmed' => 'Confirmée',
                        'pending'   => 'En attente',
                        'cancelled' => 'Annulée',
                        'attended'  => 'Présent(e)',
                    ])
                    ->label('Filtrer par statut'),
                SelectFilter::make('training_session')
                    ->relationship('trainingSession.training', 'title')
                    ->label('Filtrer par atelier'),
            ])
            ->actions([
                Action::make('markAsAttended')
                    ->label('Pointer présent')
                    ->icon('heroicon-o-check-badge')
                    ->color('info')
                    ->visible(fn (Booking $record): bool => $record->status !== 'attended')
                    ->action(function (Booking $record) {
                        $record->update(['status' => 'attended']);
                        Notification::make()->title('Présence enregistrée')->info()->send();
                    }),
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
