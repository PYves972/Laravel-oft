<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use BackedEnum;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Modération';
    }

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-chat-bubble-left-right';
    }

    protected static ?string $navigationLabel = 'Avis & Commentaires';
    protected static ?string $modelLabel = 'Commentaire';
    protected static ?string $pluralModelLabel = 'Commentaires';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->label('Auteur'),

                Select::make('training_id')
                    ->relationship('training', 'title')
                    ->disabled()
                    ->label('Formation / Atelier'),

                TextInput::make('rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->disabled()
                    ->label('Note (/5)'),

                Select::make('status')
                    ->options([
                        'pending'  => 'En attente',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                    ])
                    ->required()
                    ->label('Statut de modération'),

                RichEditor::make('content')
                    ->columnSpanFull()
                    ->disabled()
                    ->label('Contenu du commentaire'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Auteur')
                    ->searchable(),

                Tables\Columns\TextColumn::make('training.title')
                    ->label('Atelier / Formation')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Note')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('content')
                    ->label('Avis')
                    ->limit(50),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'pending'  => 'warning',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        'pending'  => 'En attente',
                        default    => $state,
                    })
                    ->label('Statut'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Publié le')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filtrer par statut')
                    ->options([
                        'pending'  => 'En attente',
                        'approved' => 'Approuvés',
                        'rejected' => 'Rejetés',
                    ]),
            ])
            ->actions([
                // Modération rapide : Bouton d'approbation
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Comment $record) => $record->update(['status' => 'approved']))
                    ->visible(fn (Comment $record) => $record->status !== 'approved'),

                // Modération rapide : Bouton de rejet
                Tables\Actions\Action::make('reject')
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
            'index'  => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit'   => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
