<?php

namespace App\Filament\Resources\Visits\Pages;

use App\Filament\Resources\Visits\VisitResource;
use Filament\Resources\Pages\CreateRecord;
use App\Enums\Roles;

class CreateVisit extends CreateRecord
{
    protected static string $resource = VisitResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        // jeśli nie admin -> ustaw aktualnego usera
        if (auth()->user()?->role !== Roles::Admin) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }
}
