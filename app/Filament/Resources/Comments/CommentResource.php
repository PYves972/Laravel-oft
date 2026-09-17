<?php

namespace App\Filament\Resources\Comments;

use BackedEnum;
use App\Models\Comment;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Actions\Action; // <-- Import corrigé ici
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
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
