<?php

return [

    'column_manager' => [

        'heading' => 'Kolonner',

        'actions' => [

            'apply' => [
                'label' => 'Anvend kolonner',
            ],

            'reset' => [
                'label' => 'Nulstil',
            ],

        ],

    ],

    'columns' => [

        'actions' => [
            'label' => 'Handling|Handlinger',
        ],

        'select' => [

            'loading_message' => 'Indlæser...',

            'no_options_message' => 'Ingen muligheder tilgængelige.',

            'no_search_results_message' => 'Ingen muligheder matcher din søgning.',

            'placeholder' => 'Vælg en mulighed',

            'searching_message' => 'Søger...',

            'search_prompt' => 'Begynd at skrive for at søge...',

        ],

        'text' => [

            'actions' => [
                'collapse_list' => 'Vis :count færre',
                'expand_list' => 'Vis :count flere',
            ],

            'more_list_items' => 'og :count mere',

        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Vælg/fravælg alle elementer til massehandlinger.',
        ],

        'bulk_select_record' => [
            'label' => 'Vælg/fravælg element :key til massehandlinger.',
        ],

        'bulk_select_group' => [
            'label' => 'Vælg/fravælg gruppe :title til massehandlinger.',
        ],

        'search' => [
            'label' => 'Søg',
            'placeholder' => 'Søg',
            'indicator' => 'Søgning',
        ],

    ],

    'summary' => [

        'heading' => 'Oversigt',

        'subheadings' => [
            'all' => 'Alle :label',
            'group' => ':group oversigt',
            'page' => 'Denne side',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Gennemsnit',
            ],

            'count' => [
                'label' => 'Antal',
            ],

            'sum' => [
                'label' => 'Sum',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Afslut omarrangering af poster',
        ],

        'enable_reordering' => [
            'label' => 'Omarranger poster',
        ],

        'filter' => [
            'label' => 'Filtrer',
        ],

        'group' => [
            'label' => 'Gruppér',
        ],

        'open_bulk_actions' => [
            'label' => 'Massehandlinger',
        ],

        'column_manager' => [
            'label' => 'Kolonnestyring',
        ],

    ],

    'empty' => [

        'heading' => 'Ingen :model',

        'description' => 'Opret en :model for at komme i gang.',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'Anvend filtre',
            ],

            'remove' => [
                'label' => 'Fjern filter',
            ],

            'remove_all' => [
                'label' => 'Fjern alle filtre',
                'tooltip' => 'Fjern alle filtre',
            ],

            'reset' => [
                'label' => 'Nulstil',
            ],

        ],

        'heading' => 'Filtre',

        'indicator' => 'Aktive filtre',

        'multi_select' => [
            'placeholder' => 'Alle',
        ],

        'select' => [

            'placeholder' => 'Alle',

            'relationship' => [
                'empty_option_label' => 'Ingen',
            ],

        ],

        'trashed' => [

            'label' => 'Slettede poster',

            'only_trashed' => 'Kun slettede poster',

            'with_trashed' => 'Med slettede poster',

            'without_trashed' => 'Uden slettede poster',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'Gruppér efter',
            ],

            'direction' => [

                'label' => 'Grupperingsretning',

                'options' => [
                    'asc' => 'Stigende',
                    'desc' => 'Faldende',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Træk og slip posterne i rækkefølge.',

    'selection_indicator' => [

        'selected_count' => '1 post valgt|:count poster valgt',

        'actions' => [

            'select_all' => [
                'label' => 'Vælg alle :count',
            ],

            'deselect_all' => [
                'label' => 'Fravælg alle',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Sortér efter',
            ],

            'direction' => [

                'label' => 'Sorteringsretning',

                'options' => [
                    'asc' => 'Stigende',
                    'desc' => 'Faldende',
                ],

            ],

        ],

    ],

    'default_model_label' => 'post',

];
