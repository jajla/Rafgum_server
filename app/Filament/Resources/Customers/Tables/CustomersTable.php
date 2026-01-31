<?php

namespace App\Filament\Resources\Customers\Tables;

use App\Enums\Roles;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\Layout\Grid;
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
                /*
                Grid::make([
                    'sm' => 1, // 📱 mały → 1 kolumna
                    'md' => 3, // 💻 średni → 3 kolumny
                    'xl' => 6, // 🖥 duży → 6 kolumn = 1 rząd (bo 6 pól)
                ])->schema([
                    TextColumn::make('id'),
                    TextColumn::make('role'),
                    TextColumn::make('name'),
                    TextColumn::make('last_name'),
                    TextColumn::make('email'),
                    TextColumn::make('phone_number'),
                ]),
                Grid::make([
                    'sm' => 1,
                    'md' => 3,
                    'lg' => 6, // 3 Stacki w jednym rzędzie
                ])->schema([
                    Stack::make([
                        TextColumn::make('id'),
                        TextColumn::make('role'),
                    ]),
                    Stack::make([
                        TextColumn::make('name'),
                        TextColumn::make('last_name'),
                    ]),
                    Stack::make([
                        TextColumn::make('email'),
                        TextColumn::make('phone_number'),
                    ]),
                ]),
                // MOBILE / SMALL: 1 kolumna
                Stack::make([
                    TextColumn::make('id'),
                    TextColumn::make('role'),
                    TextColumn::make('name'),
                    TextColumn::make('last_name'),
                    TextColumn::make('email'),
                    TextColumn::make('phone_number'),
                ])->hiddenFrom('md'),

                // MEDIUM: 3 kolumny (Split zawierający 3 Stacki)
                Split::make([
                    Stack::make([
                        TextColumn::make('id'),
                        TextColumn::make('role'),
                    ]),
                    Stack::make([
                        TextColumn::make('name'),
                        TextColumn::make('last_name'),
                    ]),
                    Stack::make([
                        TextColumn::make('email'),
                        TextColumn::make('phone_number'),
                    ]),
                ])->from('md')->hiddenFrom('xl'),

                // XL: 1 rząd (Split z wszystkimi kolumnami)
                Split::make([
                    TextColumn::make('id'),
                    TextColumn::make('role'),
                    TextColumn::make('name'),
                    TextColumn::make('last_name'),
                    TextColumn::make('email'),
                    TextColumn::make('phone_number'),
                ])->from('sm'),*/
                Split::make([
                    Stack::make([
                        TextColumn::make('id')->alignCenter(),
                        TextColumn::make('role') ->formatStateUsing(fn($state) => $state->getLabel())->icon('heroicon-m-shield-check')->alignCenter(),
                    ]),
                    Stack::make([
                        TextColumn::make('name')->alignCenter()->icon('heroicon-m-user')->searchable(),
                        TextColumn::make('last_name')->icon('heroicon-m-user')->alignCenter()->searchable(),
                    ]),
                    Stack::make([
                        TextColumn::make('email')->icon('heroicon-m-at-symbol')->alignCenter(),
                        TextColumn::make('phone_number')->icon('heroicon-m-phone')->alignCenter(),

                    ])
                ])->from('lg'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])

                /* EditAction::make(),
                 DeleteAction::make(),*/
            ])
            ->toolbarActions([
                /*  BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),*/
            ]);
    }
}
