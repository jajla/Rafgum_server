<?php

namespace App\Filament\Resources\Visits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Carbon\Carbon;
use App\Enums\Roles;

class VisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.last_name')
                    ->numeric()
                    ->sortable()
                    ->hidden(fn() => auth()->user()?->role !== Roles::Admin),
                TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)
                        ->translatedFormat('j F l')),
                TextColumn::make('time')
                    ->time()
                    ->formatStateUsing(fn($state) => date('H:i', strtotime($state)))
                    ->sortable(),
                TextColumn::make('service_type')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
            ])
            ->filters([
                //
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
