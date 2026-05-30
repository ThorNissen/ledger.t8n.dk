<?php

return [

    'title' => 'Nulstil din adgangskode',

    'heading' => 'Nulstil din adgangskode',

    'form' => [

        'email' => [
            'label' => 'E-mailadresse',
        ],

        'password' => [
            'label' => 'Adgangskode',
            'validation_attribute' => 'adgangskode',
        ],

        'password_confirmation' => [
            'label' => 'Bekræft adgangskode',
        ],

        'actions' => [

            'reset' => [
                'label' => 'Nulstil adgangskode',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'For mange nulstillingsforsøg',
            'body' => 'Prøv venligst igen om :seconds sekunder.',
        ],

    ],

];
