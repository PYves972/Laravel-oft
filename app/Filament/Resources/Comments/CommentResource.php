<?php

namespace App\Filament\Resources\Comments;

use App\Models\Comment;
use Filament\Schemas\Schema;// À la place de Filament\Schemas\Schema
use Filament\Resources\Resource;
use Filament\Tables\Table;

// Imports d'actions pour Filament v3 :
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

use App\Filament\Resources\Comments\Pages\ListComments;
use App\Filament\Resources\Comments\Pages\CreateComment;
use App\Filament\Resources\Comments\Pages\EditComment;

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
    return $schema;
}

    public static function table(Table $table): Table
    {
        return $table
            ->actions([
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
            'index' => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }
}
