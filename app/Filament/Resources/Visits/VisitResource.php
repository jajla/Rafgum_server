<?php

namespace App\Filament\Resources\Visits;

use App\Filament\Resources\Visits\Pages\CreateVisit;
use App\Filament\Resources\Visits\Pages\EditVisit;
use App\Filament\Resources\Visits\Pages\ListVisits;
use App\Filament\Resources\Visits\Schemas\VisitForm;
use App\Filament\Resources\Visits\Tables\VisitsTable;
use App\Models\Visit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Enums\Roles;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

       public static function getNavigationLabel(): string
    {
        return __('trans.Resources.Visits.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('trans.Resources.Visits.label');
    }
    public static function getPluralModelLabel(): string
    {
        return auth()->user()?->role === Roles::Admin
        ? __('trans.Resources.Visits.title_admin')
        : __('trans.Resources.Visits.title');
    }

    //protected static ?string $recordTitleAttribute = 'visit';

    public static function canEdit($record): bool
    {
    return auth()->user()?->role === Roles::Admin;
    }

    public static function form(Schema $schema): Schema
    {
        return VisitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVisits::route('/'),
            'create' => CreateVisit::route('/create'),
            'edit' => EditVisit::route('/{record}/edit'),
        ];
    }
}
