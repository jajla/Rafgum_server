<?php

namespace App\Filament\Pages\Auth;

use App\Enums\Roles;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use App\Models\User;

class Register extends BaseRegister
{
    protected bool $notificationSent = false; // flaga, żeby powiadomienie było tylko raz

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getLastNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPhoneFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label(__('filament-panels::auth/pages/register.form.name.label'))
            ->required()
            ->maxLength(15)
            ->alpha()
            ->minLength(2)
            ->autofocus();
    }

    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('last_name')
            ->label(__('filament-panels::auth/pages/register.form.last_name.label'))
            ->required()
            ->alpha()
            ->minLength(2)
            ->maxLength(20);
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone_number')
            ->label(__('filament-panels::auth/pages/register.form.phone_number.label'))
            ->tel()
            ->length(9)
            ->required();
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        Log::info(
            'Rejestracja użytkownika: imię ' . $data['name'] .
            ' nazwisko: ' . $data['last_name'] .
            ' email: ' . $data['email'] .
            ' telefon: ' . $data['phone_number']
        );
        return $data;
    }

    public function register(): ?RegistrationResponse
    {
        $response = parent::register(); // użytkownik zapisany i zalogowany

        $this->afterRegister(); // wysyłamy powiadomienie **tylko raz**

        return $response;
    }

    protected function afterRegister(): void
    {
        if ($this->notificationSent) return;
        $this->notificationSent = true;

        $data = $this->form->getState();

        $admins = User::where('role', Roles::Admin->value)->get();

        foreach ($admins as $admin) {
            Notification::make()
                ->title(__('trans.notifications.new_user.title'))
                ->body(__('trans.notifications.new_user.body', [
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'last_name' => $data['last_name'],
                ]))
                ->icon('heroicon-o-user-plus')
                ->sendToDatabase($admin);

        }
    }
}
