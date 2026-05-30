<?php

return [

    'label' => 'Sidenavigation',

    'overview' => '{1} Viser 1 resultat|[2,*] Viser :first til :last af :total resultater',

    'fields' => [

        'records_per_page' => [

            'label' => 'Per side',

            'options' => [
                'all' => 'Alle',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'Første',
        ],

        'go_to_page' => [
            'label' => 'Gå til side :page',
        ],

        'last' => [
            'label' => 'Sidste',
        ],

        'next' => [
            'label' => 'Næste',
        ],

        'previous' => [
            'label' => 'Forrige',
        ],

    ],

];
