<?php

return [

    'title' => 'Zarejestruj się',

    'heading' => 'Rejestracja',

    'actions' => [

        'login' => [
            'before' => 'lub',
            'label' => 'zaloguj się na swoje konto',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Adres e-mail',
        ],

        'name' => [
            'label' => 'Imie',
        ],

        'last_name' => [
            'label' => 'Nazwisko',
        ],

        'phone_number' => [
            'label' => 'Numer Telefonu',
        ],
        'role' => [
            'label' => 'Typ konta',
        ],

        'password' => [
            'label' => 'Hasło',
            'validation_attribute' => 'hasło',
        ],

        'password_confirmation' => [
            'label' => 'Potwierdź hasło',
        ],

        'actions' => [

            'register' => [
                'label' => 'Zarejestruj się',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Zbyt dużo prób rejestracji',
            'body' => 'Spróbuj ponownie za :seconds sekund.',
        ],

    ],

];
