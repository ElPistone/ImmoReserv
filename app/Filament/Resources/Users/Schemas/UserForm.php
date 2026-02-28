<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->label('Mot de passe')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => $state === null ? null : bcrypt($state))
                    ->required(fn($record) => ! $record),

                TextInput::make('password_confirmation')
                    ->label('Confirmation du mot de passe')
                    ->password()
                    ->required(fn($record) => ! $record)
                    ->dehydrated(false),
            ]);
    }
}
