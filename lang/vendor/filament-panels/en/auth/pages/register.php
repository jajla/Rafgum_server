<?php

return [

    'title' => 'Register',

    'heading' => 'Sign up',

    'actions' => [

        'login' => [
            'before' => 'or',
            'label' => 'sign in to your account',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Email address',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'last_name' => [
            'label' => 'Last Name',
        ],

        'phone_number' => [
            'label' => 'Phone Number',
        ],

        'role' => [
            'label' => 'Role',
        ],


        'password' => [
            'label' => 'Password',
            'validation_attribute' => 'password',
        ],

        'password_confirmation' => [
            'label' => 'Confirm password',
        ],

        'actions' => [

            'register' => [
                'label' => 'Sign up',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Too many registration attempts',
            'body' => 'Please try again in :seconds seconds.',
        ],

    ],

];
