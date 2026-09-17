<?php

namespace App\Filament\Resources\Progressions;

use BackedEnum;
use App\Models\Progression;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use App\Filament\Resources\Progressions\Pages\ListProgressions;
use App\Filament\Resources\Progressions\Pages\CreateProgression;
use App\Filament\Resources\Progressions\Pages\EditProgression;

class ProgressionResource extends Resource
{
    protected static ?string $model = Progression::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Gestion Pédagogique';
    }

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-chart-bar';
    }

    protected static ?string $navigationLabel = 'Suivi Pédagogique';
    protected static ?string $modelLabel = 'Progression';
    protected static ?string $pluralModelLabel = 'Progressions';

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProgressions::route('/'),
            'create' => CreateProgression::route('/create'),
            'edit' => EditProgression::route('/{record}/edit'),
        ];
    }
}
