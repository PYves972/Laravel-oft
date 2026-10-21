<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label('Lu')
                    ->boolean()
                    ->state(fn (ContactMessage $record): bool => filled($record->read_at)),
                TextColumn::make('created_at')->label('Reçu le')->dateTime('d/m/Y H:i')->sortable(),
                TextColumn::make('nom')->label('Nom')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('sujet')->label('Sujet')->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                Action::make('mark_read')
                    ->label('Marquer comme lu')
                    ->icon('heroicon-o-check')
                    ->visible(fn (ContactMessage $record): bool => blank($record->read_at))
                    ->action(fn (ContactMessage $record) => $record->update(['read_at' => now()])),
                Action::make('download')
                    ->label('Pièce jointe')
                    ->icon('heroicon-o-paperclip')
                    ->visible(fn (ContactMessage $record): bool => filled($record->fichier_path)
                        && Storage::disk('local')->exists($record->fichier_path))
                    ->action(fn (ContactMessage $record) => Storage::disk('local')->download($record->fichier_path)),
                DeleteAction::make(),
            ]);
    }
}
