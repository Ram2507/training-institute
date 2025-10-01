<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->revealable()
->visible(fn (string $operation): bool => $operation === 'create')
->required(fn (string $operation): bool => $operation === 'create')
,
                CheckboxList::make('roles')
    ->label('Roles')
    ->relationship('roles', 'name')
    ->columns(2)
    ->bulkToggleable(),
Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
