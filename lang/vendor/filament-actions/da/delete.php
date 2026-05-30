<?php

return [

    'single' => [

        'label' => 'Slet',

        'modal' => [

            'heading' => 'Slet :label',

            'actions' => [

                'delete' => [
                    'label' => 'Slet',
                ],

            ],

        ],

        'notifications' => [

            'deleted' => [
                'title' => 'Slettet',
            ],

        ],

    ],

    'multiple' => [

        'label' => 'Slet valgte',

        'modal' => [

            'heading' => 'Slet valgte :label',

            'actions' => [

                'delete' => [
                    'label' => 'Slet',
                ],

            ],

        ],

        'notifications' => [

            'deleted' => [
                'title' => 'Slettet',
            ],

            'deleted_partial' => [
                'title' => 'Slettede :count af :total',
                'missing_authorization_failure_message' => 'Du har ikke tilladelse til at slette :count.',
                'missing_processing_failure_message' => ':count kunne ikke slettes.',
            ],

            'deleted_none' => [
                'title' => 'Sletning mislykkedes',
                'missing_authorization_failure_message' => 'Du har ikke tilladelse til at slette :count.',
                'missing_processing_failure_message' => ':count kunne ikke slettes.',
            ],

        ],

    ],

];
