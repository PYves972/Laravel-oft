<?php

namespace App\Filament\Resources\Trainings\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $title = 'Documents Pédagogiques';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre du document')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('file_path')
                    ->label('Fichier (PDF, Word...)')
                    ->directory('pedagogical-documents')
                    ->disk('public')
                    ->preserveFilenames()
                    ->required(),

                Forms\Components\Toggle::make('is_public')
                    ->label('Rendre public sans réservation')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Déposer un document'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
