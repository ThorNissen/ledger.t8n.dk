<?php

return [

    'label' => 'Eksportér :label',

    'modal' => [

        'heading' => 'Eksportér :label',

        'form' => [

            'columns' => [

                'label' => 'Kolonner',

                'actions' => [

                    'select_all' => [
                        'label' => 'Vælg alle',
                    ],

                    'deselect_all' => [
                        'label' => 'Fravælg alle',
                    ],

                ],

                'form' => [

                    'is_enabled' => [
                        'label' => ':column aktiveret',
                    ],

                    'label' => [
                        'label' => ':column etiket',
                    ],

                ],

            ],

        ],

        'actions' => [

            'export' => [
                'label' => 'Eksportér',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Eksport fuldført',

            'actions' => [

                'download_csv' => [
                    'label' => 'Download .csv',
                ],

                'download_xlsx' => [
                    'label' => 'Download .xlsx',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Eksporten er for stor',
            'body' => 'Du kan ikke eksportere mere end 1 række ad gangen.|Du kan ikke eksportere mere end :count rækker ad gangen.',
        ],

        'no_columns' => [
            'title' => 'Ingen kolonner valgt',
            'body' => 'Vælg venligst mindst én kolonne at eksportere.',
        ],

        'started' => [
            'title' => 'Eksport startet',
            'body' => 'Din eksport er begyndt og 1 række vil blive behandlet i baggrunden. Du vil modtage en notifikation med downloadlinket, når den er fuldført.|Din eksport er begyndt og :count rækker vil blive behandlet i baggrunden. Du vil modtage en notifikation med downloadlinket, når den er fuldført.',
        ],

    ],

    'file_name' => 'eksport-:export_id-:model',

];
