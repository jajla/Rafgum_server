<?php

namespace App\Filament\Resources\Visits\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

use App\Services\VisitService;
use App\Enums\Roles;
use App\Enums\Services;
use App\Models\User;
use App\Models\Visit;

class VisitForm
{
    public static function configure(Schema $schema): Schema
    {
        $dateFormat = 'Y-m-d';
        return $schema
            ->components([            
                Select::make('user_id')
                    ->label(__('trans.form.user_id'))
                    ->native(false)
                    ->options(User::query()
                        ->get()
                        ->mapWithKeys(fn($user) => [$user->id => $user->last_name]))
                    ->required()
                    ->visible(fn () => auth()->user()?->role === Roles::Admin)
    ->required(fn () => auth()->user()?->role === Roles::Admin),
               DatePicker::make('date')
                    ->minDate(now()->format($dateFormat))
                    //->native(false)
                    ->required()
                   //->displayFormat('d F Y')
                    ->live(),
                Select::make('time')
                    ->options(fn(Get $get) => (new VisitService())->getAvailableTimesForDate($get('date')))
                    ->hidden(fn(Get $get) => !$get('date'))
                    ->required()
                    ->formatStateUsing(fn($state) => date('H:i', strtotime($state)))
                    ->native(false),

                Select::make('service_type')
                    ->label(__('trans.form.service_type'))
                    ->options(
                        collect(Services::cases())
                            ->mapWithKeys(fn($role) => [$role->value => $role->getLabel()])
                            ->toArray()
                    )->required(),
            ]);
    }
}
