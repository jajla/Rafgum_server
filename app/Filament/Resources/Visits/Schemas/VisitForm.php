<?php

namespace App\Filament\Resources\Visits\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

use Filament\Schemas\Components\Section;
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
                Section::make()
                    ->columnSpan('full')
                    ->columns(2)
                    ->schema([
                        Section::make('')
                            ->schema([
                                Select::make('user_id')
                                    ->label(__('trans.Resources.Visits.user'))
                                    ->native(false)
                                    ->options(User::query()
                                        ->get()
                                        ->mapWithKeys(fn($user) => [$user->id => $user->last_name]))
                                    ->required()
                                    ->visible(fn() => auth()->user()?->role === Roles::Admin)
                                    ->required(fn() => auth()->user()?->role === Roles::Admin),
                                DatePicker::make('date')
                                    ->label(__('trans.Resources.Visits.date'))
                                    ->minDate(now()->format($dateFormat))
                                    //->native(false)
                                    ->required()
                                    //->displayFormat('d F Y')
                                    ->live(),
                            ]),

                        Section::make([''])->schema([
                            // Select::make('time')
                            //     ->label(__('trans.Resources.Visits.time'))
                            //     ->options(fn(Get $get) => (new VisitService())->getAvailableTimesForDate($get('date')))
                            //     ->hidden(fn(Get $get) => !$get('date'))
                            //     ->required()
                            //     ->formatStateUsing(fn($state) => date('H:i', strtotime($state)))
                            //     ->native(false),

                            Select::make('time')
                                ->label(__('trans.Resources.Visits.time'))
                                ->options(
                                    fn(Get $get, $record) => (new VisitService())->getAvailableTimesForDate(
                                        $get('date'),
                                        $record?->id
                                    )
                                )
                                ->required()
                                ->formatStateUsing(fn($state) => date('H:i', strtotime($state)))
                                ->native(false),

                            Select::make('service_type')
                                ->label(__('trans.Resources.Visits.service'))
                                ->options(
                                    collect(Services::cases())
                                        ->mapWithKeys(fn($role) => [$role->value => $role->getLabel()])
                                        ->toArray()
                                )->required(),
                        ])
                    ])
            ]);
    }
}
