<?php

return [

    'title' => 'Nulstil din adgangskode',

    'heading' => 'Glemt adgangskode?',

    'actions' => [

        'login' => [
            'label' => 'tilbage til login',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'E-mailadresse',
        ],

        'actions' => [

            'request' => [
                'label' => 'Send e-mail',
            ],

        ],

    ],

    'notifications' => [

        'sent' => [
            'body' => 'Hvis din konto ikke eksisterer, vil du ikke modtage e-mailen.',
        ],

        'throttled' => [
            'title' => 'For mange anmodninger',
            'body' => 'Prøv venligst igen om :seconds sekunder.',
        ],

    ],

];
