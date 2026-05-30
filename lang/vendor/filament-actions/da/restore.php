<?php

return [

    'single' => [

        'label' => 'Gendan',

        'modal' => [

            'heading' => 'Gendan :label',

            'actions' => [

                'restore' => [
                    'label' => 'Gendan',
                ],

            ],

        ],

        'notifications' => [

            'restored' => [
                'title' => 'Gendannet',
            ],

        ],

    ],

    'multiple' => [

        'label' => 'Gendan valgte',

        'modal' => [

            'heading' => 'Gendan valgte :label',

            'actions' => [

                'restore' => [
                    'label' => 'Gendan',
                ],

            ],

        ],

        'notifications' => [

            'restored' => [
                'title' => 'Gendannet',
            ],

            'restored_partial' => [
                'title' => 'Gendanede :count af :total',
                'missing_authorization_failure_message' => 'Du har ikke tilladelse til at gendanne :count.',
                'missing_processing_failure_message' => ':count kunne ikke gendannes.',
            ],

            'restored_none' => [
                'title' => 'Gendannelse mislykkedes',
                'missing_authorization_failure_message' => 'Du har ikke tilladelse til at gendanne :count.',
                'missing_processing_failure_message' => ':count kunne ikke gendannes.',
            ],

        ],

    ],

];
