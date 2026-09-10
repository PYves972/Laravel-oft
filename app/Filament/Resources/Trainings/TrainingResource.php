<?php

namespace App\Filament\Resources\Trainings;

use App\Models\Training;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components;
use Filament\Actions;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationLabel = 'Ateliers & Formations';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion des Ateliers';
    }

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-academic-cap';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Champ d'association à la catégorie (obligatoire en BDD)
                Components\Select::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255),

                Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'atelier' => 'Atelier',
                        'formation' => 'Formation',
                    ])
                    ->default('atelier')
                    ->required(),

                Components\FileUpload::make('image_path')
                    ->label('Image de présentation')
                    ->image()
                    ->disk('public')
                    ->directory('trainings')
                    ->visibility('public')
                    ->columnSpanFull(),

                Components\TextInput::make('price')
                    ->label('Prix (€)')
                    ->numeric()
                    ->prefix('€')
                    ->required(),

                Components\TextInput::make('duration_minutes')
                    ->label('Durée (minutes)')
                    ->numeric()
                    ->default(120),

                Components\Toggle::make('is_active')
                    ->label('Actif (Visible sur le site)')
                    ->default(true),

                Components\RichEditor::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'formation' => 'warning',
                        default => 'info',
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->label('Prix')
                    ->money('EUR')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Filtrer par type')
                    ->options([
                        'atelier' => 'Atelier',
                        'formation' => 'Formation',
                    ]),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->label('+ Nouveau')
                    ->button(),
            ])
            ->actions([
                Actions\EditAction::make()
                    ->iconButton()
                    ->icon('heroicon-o-pencil-square')
                    ->color('info'),
                Actions\DeleteAction::make()
                    ->iconButton()
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
