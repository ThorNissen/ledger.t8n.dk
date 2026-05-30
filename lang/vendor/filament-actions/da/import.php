<?php

return [

    'label' => 'Importér :label',

    'modal' => [

        'heading' => 'Importér :label',

        'form' => [

            'file' => [

                'label' => 'Fil',

                'placeholder' => 'Upload en CSV-fil',

                'rules' => [
                    'duplicate_columns' => '{0} Filen må ikke indeholde mere end én tom kolonneoverskrift.|{1,*} Filen må ikke indeholde duplikerede kolonneoverskrifter: :columns.',
                ],

            ],

            'columns' => [
                'label' => 'Kolonner',
                'placeholder' => 'Vælg en kolonne',
            ],

        ],

        'actions' => [

            'download_example' => [
                'label' => 'Download eksempel CSV-fil',
            ],

            'import' => [
                'label' => 'Importér',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Import fuldført',

            'actions' => [

                'download_failed_rows_csv' => [
                    'label' => 'Download information om den mislykkede række|Download information om de mislykkede rækker',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Den uploadede CSV-fil er for stor',
            'body' => 'Du kan ikke importere mere end 1 række ad gangen.|Du kan ikke importere mere end :count rækker ad gangen.',
        ],

        'started' => [
            'title' => 'Import startet',
            'body' => 'Din import er begyndt og 1 række vil blive behandlet i baggrunden.|Din import er begyndt og :count rækker vil blive behandlet i baggrunden.',
        ],

    ],

    'example_csv' => [
        'file_name' => ':importer-eksempel',
    ],

    'failure_csv' => [
        'file_name' => 'import-:import_id-:csv_name-mislykkede-rækker',
        'error_header' => 'fejl',
        'system_error' => 'Systemfejl, kontakt venligst support.',
        'column_mapping_required_for_new_record' => 'Kolonnen :attribute var ikke tilknyttet en kolonne i filen, men den er påkrævet for at oprette nye poster.',
    ],

];
