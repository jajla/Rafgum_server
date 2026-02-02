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
            ->searchable(['name', 'last_name', 'email'])
            ->paginated([100,'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
//GRID
                /*    Grid::make([
                        'sm' => 1, // 📱 mały → 1 kolumna
                        'md' => 2, // 💻 średni → 3 kolumny
                        'xl' => 4, // 🖥 duży → 6 kolumn = 1 rząd (bo 6 pól)
                    ])->schema([
                       // TextColumn::make('id'),
                       // TextColumn::make('role'),
                        TextColumn::make('name')->alignCenter(),
                        TextColumn::make('last_name')->alignCenter(),
                        TextColumn::make('phone_number')->alignCenter(),
                        TextColumn::make('email')->icon('heroicon-m-at-symbol')->alignCenter(),
                    ]),*/

                Split::make([
                    Stack::make([
                        TextColumn::make('id')
                            ->alignCenter(),
                        TextColumn::make('role')
                            ->formatStateUsing(fn($state) => $state->getLabel())->icon('heroicon-m-shield-check')
                            ->alignCenter(),
                    ]),
                    Stack::make([
                        TextColumn::make('name')
                            ->alignCenter()
                            ->icon('heroicon-m-user'),
                        TextColumn::make('last_name')
                            ->icon('heroicon-m-user')
                            ->alignCenter(),
                    ]),
                    Stack::make([
                        TextColumn::make('email')->icon('heroicon-m-at-symbol')
                            ->alignCenter(),

                        TextColumn::make('phone_number')
                            ->icon('heroicon-m-phone')
                            ->alignCenter(),

                    ])
                ])->from('md'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                /*  BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),*/
            ]);
    }
}
