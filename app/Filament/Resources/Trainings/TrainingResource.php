<?php
namespace App\Filament\Resources\Trainings;

use App\Filament\Resources\Trainings\Pages;
use App\Models\Training;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
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
                Section::make('Informations Principales')
                    ->schema([
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

                        Toggle::make('is_active')
                            ->label('Actif / Visible')
                            ->default(true),

                        RichEditor::make('description')
                            ->label('Description courte (Cartes & Offres)')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Visuels de l\'Atelier')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Image de couverture (Nos Offres)')
                            ->image()
                            ->disk('public')
                            ->directory('trainings/covers')
                            ->visibility('public')
                            ->required(),

                        FileUpload::make('gallery_images')
                            ->label('Galerie Photos (Page "En savoir plus")')
                            ->image()
                            ->multiple()
                            ->disk('public')
                            ->directory('trainings/galleries')
                            ->visibility('public')
                            ->maxFiles(5),
                    ])->columns(2),

                Section::make('Détails "En Savoir Plus"')
                    ->schema([
                        Textarea::make('prerequisites')
                            ->label('Prérequis (ex: Ouvert aux débutants)'),

                        Textarea::make('provided_equipment')
                            ->label('Matériel fourni sur place'),

                        Textarea::make('required_equipment')
                            ->label('Ce que le participant doit apporter'),

                        Repeater::make('program_steps')
                            ->label('Déroulement de la séance')
                            ->schema([
                                TextInput::make('time')->label('Durée / Étape (ex: 30 min)'),
                                TextInput::make('title')->label('Titre de l\'étape'),
                                Textarea::make('description')->label('Explication'),
                            ])
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
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
