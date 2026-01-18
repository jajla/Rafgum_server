<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Enums\Roles;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament-panels::auth/pages/register.form.name.label')),
                TextInput::make('last_name')
                    ->label(__('filament-panels::auth/pages/register.form.last_name.label')),
                TextInput::make('phone_number')
                    ->label(__('filament-panels::auth/pages/register.form.phone_number.label')),
                TextInput::make('email')->reactive() // reaguje na zmiany w formularzu
                ->disabled(fn($get) => $get('role') === Roles::Guest->value)
                    ->afterStateHydrated(function ($component, $state, $record) {
                        if ($record && $record->role === Roles::Guest->value) {
                            $component->disabled(true);
                        }
                    }),
                Select::make('role')
                    ->label(__('filament-panels::auth/pages/register.form.role.label'))
                    ->reactive()
                    ->options(
                        collect(Roles::cases())
                            ->mapWithKeys(fn($role) => [$role->value => $role->getLabel()])
                            ->toArray()
                    ),
            ]);
    }
}
