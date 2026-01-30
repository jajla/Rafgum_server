<?php

namespace App\Filament\Resources\Customers\Tables;

use App\Enums\Roles;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->paginated([25, 50, 100])
            ->defaultPaginationPageOption(100)
            ->columns([
                /* Textcolumn::make('id')
                     ->alignCenter()
                     ->sortable(),
                 TextColumn::make('name')
                     ->searchable()
                     ->alignCenter()
                     ->label(__('filament-panels::auth/pages/register.form.name.label')),
                 TextColumn::make('last_name')
                     ->searchable()
                     ->alignCenter()
                     ->label(__('filament-panels::auth/pages/register.form.last_name.label')),
                 TextColumn::make('phone_number')
                     ->alignCenter()
                     ->label(__('filament-panels::auth/pages/register.form.phone_number.label')),
                 TextColumn::make('email'),
                 TextColumn::make('role')
                     ->alignCenter()
                     ->label(__('filament-panels::auth/pages/register.form.role.label'))
                     ->formatStateUsing(fn($state) => $state->getLabel())
                 //  TextColumn::make('created_at')->dateTime('d.m.Y H:i:s'),


                // to juz fajnie dziala tylko wycentrowac
                Split::make([
                    TextColumn::make('id'),
                    TextColumn::make('name')
                        ->label(__('filament-panels::auth/pages/register.form.name.label'))
                        ->searchable(),
                    TextColumn::make('last_name')
                        ->label(__('filament-panels::auth/pages/register.form.last_name.label'))
                        ->searchable(),
                    TextColumn::make('email'),
                    TextColumn::make('phone_number')
                        ->label(__('filament-panels::auth/pages/register.form.phone_number.label')),
                    TextColumn::make('role')
                        ->label(__('filament-panels::auth/pages/register.form.role.label'))
                        ->formatStateUsing(fn($state) => $state->getLabel()),
                ])
                    ->from('xl')*/
                Split::make([
                    TextColumn::make('id')
                        ->icon('heroicon-o-hashtag')
                        ->label('ID'),

                    TextColumn::make('name')
                        ->icon('heroicon-o-user-circle')
                        ->label(__('filament-panels::auth/pages/register.form.name.label'))
                        ->searchable(),

                    TextColumn::make('last_name')
                        ->label(__('filament-panels::auth/pages/register.form.last_name.label'))
                        ->searchable(),
                ])->from('sm'),

                // ===== WIERSZ 2 =====
                Split::make([
                    TextColumn::make('email')->icon('heroicon-o-envelope'),

                    TextColumn::make('phone_number')
                        ->icon('heroicon-o-phone')
                        ->label(__('filament-panels::auth/pages/register.form.phone_number.label')),

                    TextColumn::make('role')
                        ->label(__('filament-panels::auth/pages/register.form.role.label'))
                        ->formatStateUsing(fn ($state) => $state->getLabel()),
                ])->from('xl'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                /*  BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),*/
            ]);
    }
}
