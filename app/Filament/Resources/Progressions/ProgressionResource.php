<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgressionResource\Pages;
use App\Models\Progression;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ProgressionResource extends Resource
{
    protected static ?string $model = Progression::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion Pédagogique';
    }

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-chart-bar';
    }

    protected static ?string $navigationLabel = 'Suivi Pédagogique';
    protected static ?string $modelLabel = 'Progression';
    protected static ?string $pluralModelLabel = 'Progressions';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->label('Membre / Apprenant'),

                Select::make('training_id')
                    ->relationship('training', 'title')
                    ->searchable()
                    ->required()
                    ->label('Formation / Atelier'),

                TextInput::make('percentage')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->default(0)
                    ->required()
                    ->label('Taux de progression (0 - 100%)'),

                RichEditor::make('notes')
                    ->columnSpanFull()
                    ->label('Note pédagogique (Remarques du formateur)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Membre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('training.title')
                    ->label('Formation')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('percentage')
                    ->label('Progression')
                    ->formatStateUsing(fn (int $state): string => "{$state} %")
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_completed')
                    ->boolean()
                    ->label('Terminée')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Dernière MàJ')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('training_id')
                    ->relationship('training', 'title')
                    ->label('Filtrer par formation'),

                Tables\Filters\TernaryFilter::make('is_completed')
                    ->label('Statut de complétion')
                    ->trueLabel('Formations terminées (100%)')
                    ->falseLabel('En cours (< 100%)'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProgressions::route('/'),
            'create' => Pages\CreateProgression::route('/create'),
            'edit'   => Pages\EditProgression::route('/{record}/edit'),
        ];
    }
}
