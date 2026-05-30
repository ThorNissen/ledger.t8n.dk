<?php

return [

    'single' => [

        'label' => 'Slet permanent',

        'modal' => [

            'heading' => 'Slet :label permanent',

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

        'label' => 'Slet valgte permanent',

        'modal' => [

            'heading' => 'Slet valgte :label permanent',

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
