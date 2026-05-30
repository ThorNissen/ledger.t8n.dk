<?php

return [

    'accounts' => [
        'is_active' => 'Aktiv',
        'import_csv' => 'Importér CSV',
        'step_upload' => 'Upload',
        'step_upload_description' => 'Upload din CSV-transaktionsfil',
        'step_map' => 'Tilknyt kolonner',
        'step_map_description' => 'Fortæl os hvilken kolonne der er hvad',
        'field_csv_file' => 'CSV-fil',
        'field_date_column' => 'Datokolonne',
        'field_description_column' => 'Beskrivelseskolonne',
        'field_amount_column' => 'Beløbskolonne',
        'field_external_id_column' => 'Ekstern ID-kolonne (valgfri)',
        'placeholder_skip' => 'Spring over',
        'import_queued' => 'Import sat i kø',
    ],

    'transactions' => [
        'column_type' => 'Type',
        'column_category' => 'Kategori',
        'column_account' => 'Konto',
        'filter_category' => 'Kategori',
        'filter_type' => 'Type',
        'filter_uncategorized' => 'Kun ukategoriserede',
        'filter_from' => 'Fra',
        'filter_until' => 'Til',
        'placeholder_uncategorized' => 'Ukategoriseret',
    ],

    'rules' => [
        'column_type' => 'Type',
        'column_category' => 'Kategori',
        'column_case' => 'Store/små bogstaver',
        'column_enabled' => 'Aktiveret',
        'filter_enabled' => 'Kun aktiverede',
        'recategorize_label' => 'Kør kategorisering igen',
        'recategorize_heading' => 'Kør kategorisering igen',
        'recategorize_description' => 'Dette anvender alle aktiverede regler på dine ukategoriserede transaktioner. Allerede kategoriserede transaktioner ændres ikke.',
        'recategorize_submit' => 'Kør',
        'recategorize_queued_title' => 'Kategorisering sat i kø',
        'recategorize_queued_body' => 'Dine transaktioner kategoriseres i baggrunden.',
    ],

    'categories' => [
        'column_types' => 'Typer',
        'column_system' => 'System',
    ],

    'transaction_types' => [
        'column_category' => 'Kategori',
        'column_group' => 'Gruppe',
        'column_system' => 'System',
        'filter_category' => 'Kategori',
    ],

    'rule_suggestions' => [
        'column_suggested_type' => 'Foreslået type',
        'column_reviewed' => 'Gennemgået',
        'column_accepted' => 'Accepteret',
        'filter_pending' => 'Afventer gennemgang',
        'action_accept' => 'Acceptér',
        'action_reject' => 'Afvis',
        'action_bulk_accept' => 'Acceptér valgte',
        'bulk_accept_description' => 'Der oprettes en regel for hvert valgt forslag med den foreslåede transaktionstype. Forslag uden foreslået type springes over.',
        'field_keyword_helper' => 'Det nøgleord, der skal matches mod transaktionsbeskrivelser.',
        'field_transaction_type' => 'Transaktionstype',
        'notification_rule_created_title' => 'Regel oprettet',
        'notification_rule_created_body' => 'Nøgleord ":keyword" vil nu automatisk blive kategoriseret.',
        'notification_bulk_created' => ':count regel oprettet|:count regler oprettet',
        'notification_bulk_skipped' => ', :count sprunget over',
    ],

    'widgets' => [
        'expenses_by_category' => 'Udgifter pr. kategori',
        'income_by_category' => 'Indkomst pr. kategori',
        'filter_month' => 'Denne måned',
        'filter_quarter' => 'Dette kvartal',
        'filter_year' => 'Dette år',
        'filter_all' => 'Hele perioden',
    ],

];
