<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')->label('Nom'),
                TextInput::make('prenom')->label('Prénom'),
                TextInput::make('email')->label('Email'),
                TextInput::make('telephone')->label('Téléphone'),
                TextInput::make('sujet')->label('Sujet'),
                TextInput::make('niveau')->label('Niveau'),
                Textarea::make('message')->label('Message')->rows(8)->columnSpanFull(),
            ]);
    }
}
