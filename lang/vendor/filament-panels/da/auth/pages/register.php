<?php

return [

    'title' => 'Registrer',

    'heading' => 'Opret konto',

    'actions' => [

        'login' => [
            'before' => 'eller',
            'label' => 'log ind på din konto',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'E-mailadresse',
        ],

        'name' => [
            'label' => 'Navn',
        ],

        'password' => [
            'label' => 'Adgangskode',
            'validation_attribute' => 'adgangskode',
        ],

        'password_confirmation' => [
            'label' => 'Bekræft adgangskode',
        ],

        'actions' => [

            'register' => [
                'label' => 'Opret konto',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'For mange registreringsforsøg',
            'body' => 'Prøv venligst igen om :seconds sekunder.',
        ],

    ],

];
