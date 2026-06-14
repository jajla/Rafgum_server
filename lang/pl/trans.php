<?php

return [
    'notifications' => [
        'new_user' => [
            'title' => 'Nowy użytkownik zarejestrowany',
            'body' => 'Email: :email Imię: :name Nazwisko: :last_name',
        ]
    ],

    'feedback' => [
        'navigation' => 'Opinie',
        'title' => 'Opinie Klientów',
        'submit'=> 'wyślij opinie',
        'label' => 'Czego brakuje na naszej stronie twoim zdaniem?',
    ],

    'Resources' => [
        'Customers' => [
            'navigation' => 'Klienci',
            'title' => 'Lista klientow',
            'label' => 'Profl Klienta',
        ],
        'Visits'=>[
            'navigation' => 'Terminy',
            'title_admin' => 'Lista zapisanych klientow',
            'title' => 'twoje terminy',
            'label' => 'Wizyte',
            'user'=>'Klient',
            'date'=> 'dzien',
            'time'=>'czas',
            'service'=>'usluga'
        ]
    ]
];
