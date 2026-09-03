<?php

namespace App\Filament\Resources\Trainings;

use App\Filament\Resources\Trainings\Pages;
use App\Models\Training;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationLabel = 'Ateliers & Formations';
    protected static ?string $modelLabel = 'Atelier / Formation';
    protected static ?string $pluralModelLabel = 'Ateliers & Formations';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('title')
                    ->label('Titre de l\'atelier')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                TextInput::make('slug')
                    ->label('URL (Slug)')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('price')
                    ->label('Prix (€)')
                    ->numeric()
                    ->prefix('€')
                    ->required(),

                TextInput::make('duration_minutes')
                    ->label('Durée (en minutes)')
                    ->numeric()
                    ->default(120),

                RichEditor::make('description')
                    ->label('Description complète')
                    ->columnSpanFull(),

FileUpload::make('image_path')
    ->label('Image de présentation')
    ->image()
    ->disk('public') // <-- Ajoutez ceci
    ->directory('trainings')
    ->visibility('public')
    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Actif / Visible')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
ImageColumn::make('image_path')
    ->label('Image')
    ->disk('public') // <-- Ajoutez ceci
    ->square(),

                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Prix')
                    ->money('EUR')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
