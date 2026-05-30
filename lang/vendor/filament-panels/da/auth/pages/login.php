<?php

return [

    'title' => 'Log ind',

    'heading' => 'Log ind',

    'actions' => [

        'register' => [
            'before' => 'eller',
            'label' => 'opret en konto',
        ],

        'request_password_reset' => [
            'label' => 'Glemt adgangskode?',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'E-mailadresse',
        ],

        'password' => [
            'label' => 'Adgangskode',
        ],

        'remember' => [
            'label' => 'Husk mig',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Log ind',
            ],

        ],

    ],

    'multi_factor' => [

        'heading' => 'Bekræft din identitet',

        'subheading' => 'For at fortsætte med at logge ind skal du bekræfte din identitet.',

        'form' => [

            'provider' => [
                'label' => 'Hvordan vil du bekræfte?',
            ],

            'actions' => [

                'authenticate' => [
                    'label' => 'Bekræft login',
                ],

            ],

        ],

    ],

    'messages' => [

        'failed' => 'Disse oplysninger stemmer ikke overens med vores registreringer.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'For mange loginforsøg',
            'body' => 'Prøv venligst igen om :seconds sekunder.',
        ],

    ],

];
