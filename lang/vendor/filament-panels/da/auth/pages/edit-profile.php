<?php

return [

    'label' => 'Profil',

    'form' => [

        'email' => [
            'label' => 'E-mailadresse',
        ],

        'name' => [
            'label' => 'Navn',
        ],

        'password' => [
            'label' => 'Ny adgangskode',
            'validation_attribute' => 'adgangskode',
        ],

        'password_confirmation' => [
            'label' => 'Bekræft ny adgangskode',
            'validation_attribute' => 'adgangskodebekræftelse',
        ],

        'current_password' => [
            'label' => 'Nuværende adgangskode',
            'below_content' => 'Bekræft venligst din adgangskode af sikkerhedshensyn for at fortsætte.',
            'validation_attribute' => 'nuværende adgangskode',
        ],

        'actions' => [

            'save' => [
                'label' => 'Gem ændringer',
            ],

        ],

    ],

    'multi_factor_authentication' => [
        'label' => 'To-faktor-godkendelse (2FA)',
    ],

    'notifications' => [

        'email_change_verification_sent' => [
            'title' => 'Anmodning om ændring af e-mailadresse sendt',
            'body' => 'En anmodning om at ændre din e-mailadresse er sendt til :email. Tjek venligst din e-mail for at bekræfte ændringen.',
        ],

        'saved' => [
            'title' => 'Gemt',
        ],

        'throttled' => [
            'title' => 'For mange anmodninger. Prøv venligst igen om :seconds sekunder.',
            'body' => 'Prøv venligst igen om :seconds sekunder.',
        ],

    ],

    'actions' => [

        'cancel' => [
            'label' => 'Annuller',
        ],

    ],

];
