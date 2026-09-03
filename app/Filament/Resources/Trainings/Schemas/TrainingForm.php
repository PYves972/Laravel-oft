<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TrainingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('learning_objectives')
                    ->columnSpanFull(),
                TextInput::make('duration_minutes')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('color')
                    ->required()
                    ->default('teal'),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(5),
                Textarea::make('materials')
                    ->columnSpanFull(),
            ]);
    }
}
