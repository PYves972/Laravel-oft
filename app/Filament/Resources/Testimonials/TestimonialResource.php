<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages;
use App\Models\Testimonial;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    //protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Témoignages';
    protected static ?string $modelLabel = 'Témoignage';
    protected static ?string $pluralModelLabel = 'Témoignages';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('author')
                    ->label('Auteur / Nom')
                    ->required()
                    ->maxLength(255),

                TextInput::make('role')
                    ->label('Rôle / Description (ex: Élève Atelier Couture)')
                    ->maxLength(255),

                Textarea::make('content')
                    ->label('Contenu du témoignage')
                    ->required()
                    ->columnSpanFull(),

                Select::make('rating')
                    ->label('Note')
                    ->options([
                        1 => '1 étoile',
                        2 => '2 étoiles',
                        3 => '3 étoiles',
                        4 => '4 étoiles',
                        5 => '5 étoiles',
                    ])
                    ->default(5)
                    ->required(),

                Toggle::make('is_published')
                    ->label('Publié sur le site')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author')
                    ->label('Auteur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label('Rôle')
                    ->searchable(),

                TextColumn::make('rating')
                    ->label('Note')
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Statut de publication'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
