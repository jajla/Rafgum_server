<?php

namespace App\Filament\Resources\Visits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Carbon\Carbon;
use App\Enums\Roles;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use App\Enums\Services;


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
                          ->formatStateUsing(fn (Services $state) => $state->getLabel()),
                TextColumn::make('status'),
            ])   ->modifyQueryUsing(function (Builder $query) {
        $user = auth()->user();

        if ($user->role === Roles::Admin) {
            return $query;
        }

        return $query->where('user_id', $user->id);
    })
            ->filters([
                //         Filter::make('date')
                // ->form([
                //     DatePicker::make('date')
                //         ->label('Data wizyt')
                //         ->default(today())
                //         ->native(false),
                // ])
                // ->query(function (Builder $query, array $data) {
                //     return $query->whereDate(
                //         'date',
                //         $data['date'] ?? today()
                //     );
                // }),
            ])
            ->recordActions([
                EditAction::make()->authorize(fn($record) => auth()->user()?->role === Roles::Admin),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
