<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function afterCreate(): void
    {
        $customer = $this->record; // nowo utworzony użytkownik

        Notification::make()
            ->title('Dodano nowego klienta')
            ->body('Klient: ' . $customer->name)
            ->success()
            ->sendToDatabase(auth()->user()); // do aktualnie zalogowanego admina
    }
}
