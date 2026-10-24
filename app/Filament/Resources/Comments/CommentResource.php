<?php

namespace App\Filament\Resources\Comments;

use App\Filament\Resources\Comments\Pages\CreateComment;
use App\Filament\Resources\Comments\Pages\EditComment;
use App\Filament\Resources\Comments\Pages\ListComments;
use App\Models\Comment;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Modération';
    }

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-chat-bubble-left-right';
    }

    protected static ?string $navigationLabel = 'Avis & Commentaires';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->label('Membre')
                ->relationship('user', 'name')
                ->required(),

            Select::make('training_id')
                ->label('Atelier')
                ->relationship('training', 'title')
                ->required(),

            Textarea::make('content')
                ->label('Commentaire')
                ->required()
                ->columnSpanFull(),

            TextInput::make('rating')
                ->label('Note')
                ->numeric()
                ->minValue(1)
                ->maxValue(5)
                ->required(),

            Select::make('status')
                ->label('Statut')
                ->options([
                    'pending'  => 'En attente',
                    'approved' => 'Approuvé',
                    'rejected' => 'Rejeté',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Membre')
                    ->searchable(),

                TextColumn::make('training.title')
                    ->label('Atelier'),

                TextColumn::make('rating')
                    ->label('Note'),

                TextColumn::make('content')
                    ->label('Commentaire')
                    ->limit(60),

                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default    => 'warning',
                    }),

                TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Comment $record) => $record->update(['status' => 'approved']))
                    ->visible(fn (Comment $record) => $record->status !== 'approved'),

                Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn (Comment $record) => $record->update(['status' => 'rejected']))
                    ->visible(fn (Comment $record) => $record->status !== 'rejected'),

                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'edit'   => EditComment::route('/{record}/edit'),
        ];
    }
}
