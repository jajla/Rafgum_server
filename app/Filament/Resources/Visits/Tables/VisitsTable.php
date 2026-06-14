<?php

namespace App\Filament\Resources\Visits\Tables;

use App\Enums\Roles;
use App\Enums\Services;
use Carbon\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;

class VisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.last_name')
                    ->searchable()
                    ->hidden(fn() => auth()->user()?->role !== Roles::Admin),
                TextColumn::make('date')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)
                        ->translatedFormat('j F l')),
                TextColumn::make('time')
                    ->formatStateUsing(fn($state) => date('H:i', strtotime($state))),
                TextColumn::make('service_type')
                    ->formatStateUsing(fn(Services $state) => $state->getLabel()),
                TextColumn::make('status'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();
                if ($user->role === Roles::Admin) {
                    return $query;
                }
                return $query
                    ->where('user_id', $user->id);
            })
            ->filters([
                Filter::make('date')
                    ->form([
                        DatePicker::make('date')
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['date'])) {
                            $query->whereDate('date', $data['date']);
                        }
                    })
            ])
            ->recordActions([
                EditAction::make(), // ->authorize(fn($record) => auth()->user()?->role === Roles::Admin),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
