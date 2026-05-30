<?php

return [

    'builder' => [

        'actions' => [

            'clone' => [
                'label' => 'Duplikér',
            ],

            'add' => [

                'label' => 'Tilføj til :label',

                'modal' => [

                    'heading' => 'Tilføj til :label',

                    'actions' => [

                        'add' => [
                            'label' => 'Tilføj',
                        ],

                    ],

                ],

            ],

            'add_between' => [

                'label' => 'Indsæt mellem blokke',

                'modal' => [

                    'heading' => 'Tilføj til :label',

                    'actions' => [

                        'add' => [
                            'label' => 'Tilføj',
                        ],

                    ],

                ],

            ],

            'delete' => [
                'label' => 'Slet',
            ],

            'edit' => [

                'label' => 'Rediger',

                'modal' => [

                    'heading' => 'Rediger blok',

                    'actions' => [

                        'save' => [
                            'label' => 'Gem ændringer',
                        ],

                    ],

                ],

            ],

            'reorder' => [
                'label' => 'Flyt',
            ],

            'move_down' => [
                'label' => 'Flyt ned',
            ],

            'move_up' => [
                'label' => 'Flyt op',
            ],

            'collapse' => [
                'label' => 'Skjul',
            ],

            'expand' => [
                'label' => 'Udvid',
            ],

            'collapse_all' => [
                'label' => 'Skjul alle',
            ],

            'expand_all' => [
                'label' => 'Udvid alle',
            ],

        ],

    ],

    'checkbox_list' => [

        'actions' => [

            'deselect_all' => [
                'label' => 'Fravælg alle',
            ],

            'select_all' => [
                'label' => 'Vælg alle',
            ],

        ],

    ],

    'file_upload' => [

        'editor' => [

            'actions' => [

                'cancel' => [
                    'label' => 'Annuller',
                ],

                'drag_crop' => [
                    'label' => 'Trækmetode "beskær"',
                ],

                'drag_move' => [
                    'label' => 'Trækmetode "flyt"',
                ],

                'flip_horizontal' => [
                    'label' => 'Spejlvend billede vandret',
                ],

                'flip_vertical' => [
                    'label' => 'Spejlvend billede lodret',
                ],

                'move_down' => [
                    'label' => 'Flyt billede ned',
                ],

                'move_left' => [
                    'label' => 'Flyt billede til venstre',
                ],

                'move_right' => [
                    'label' => 'Flyt billede til højre',
                ],

                'move_up' => [
                    'label' => 'Flyt billede op',
                ],

                'reset' => [
                    'label' => 'Nulstil',
                ],

                'rotate_left' => [
                    'label' => 'Rotér billede til venstre',
                ],

                'rotate_right' => [
                    'label' => 'Rotér billede til højre',
                ],

                'set_aspect_ratio' => [
                    'label' => 'Sæt billedformat til :ratio',
                ],

                'save' => [
                    'label' => 'Gem',
                ],

                'zoom_100' => [
                    'label' => 'Zoom billede til 100%',
                ],

                'zoom_in' => [
                    'label' => 'Zoom ind',
                ],

                'zoom_out' => [
                    'label' => 'Zoom ud',
                ],

            ],

            'fields' => [

                'height' => [
                    'label' => 'Højde',
                    'unit' => 'px',
                ],

                'rotation' => [
                    'label' => 'Rotation',
                    'unit' => 'grader',
                ],

                'width' => [
                    'label' => 'Bredde',
                    'unit' => 'px',
                ],

                'x_position' => [
                    'label' => 'X',
                    'unit' => 'px',
                ],

                'y_position' => [
                    'label' => 'Y',
                    'unit' => 'px',
                ],

            ],

            'aspect_ratios' => [

                'label' => 'Billedformater',

                'no_fixed' => [
                    'label' => 'Fri',
                ],

            ],

            'svg' => [

                'messages' => [
                    'confirmation' => 'Redigering af SVG-filer anbefales ikke, da det kan medføre kvalitetstab ved skalering.\n Er du sikker på, at du vil fortsætte?',
                    'disabled' => 'Redigering af SVG-filer er deaktiveret, da det kan medføre kvalitetstab ved skalering.',
                ],

            ],

        ],

    ],

    'key_value' => [

        'actions' => [

            'add' => [
                'label' => 'Tilføj række',
            ],

            'delete' => [
                'label' => 'Slet række',
            ],

            'reorder' => [
                'label' => 'Omarranger række',
            ],

        ],

        'fields' => [

            'key' => [
                'label' => 'Nøgle',
            ],

            'value' => [
                'label' => 'Værdi',
            ],

        ],

    ],

    'markdown_editor' => [

        'file_attachments_accepted_file_types_message' => 'Uploadede filer skal være af typen: :values.',

        'file_attachments_max_size_message' => 'Uploadede filer må ikke overstige :max kilobytes.',

        'tools' => [
            'attach_files' => 'Vedhæft filer',
            'blockquote' => 'Blokcitat',
            'bold' => 'Fed',
            'bullet_list' => 'Punktliste',
            'code_block' => 'Kodeblok',
            'heading' => 'Overskrift',
            'italic' => 'Kursiv',
            'link' => 'Link',
            'ordered_list' => 'Nummereret liste',
            'redo' => 'Gentag',
            'strike' => 'Gennemstreget',
            'table' => 'Tabel',
            'undo' => 'Fortryd',
        ],

    ],

    'modal_table_select' => [

        'actions' => [

            'select' => [

                'label' => 'Vælg',

                'actions' => [

                    'select' => [
                        'label' => 'Vælg',
                    ],

                ],

            ],

        ],

    ],

    'radio' => [

        'boolean' => [
            'true' => 'Ja',
            'false' => 'Nej',
        ],

    ],

    'repeater' => [

        'actions' => [

            'add' => [
                'label' => 'Tilføj til :label',
            ],

            'add_between' => [
                'label' => 'Indsæt imellem',
            ],

            'delete' => [
                'label' => 'Slet',
            ],

            'clone' => [
                'label' => 'Duplikér',
            ],

            'reorder' => [
                'label' => 'Flyt',
            ],

            'move_down' => [
                'label' => 'Flyt ned',
            ],

            'move_up' => [
                'label' => 'Flyt op',
            ],

            'collapse' => [
                'label' => 'Skjul',
            ],

            'expand' => [
                'label' => 'Udvid',
            ],

            'collapse_all' => [
                'label' => 'Skjul alle',
            ],

            'expand_all' => [
                'label' => 'Udvid alle',
            ],

        ],

    ],

    'rich_editor' => [

        'actions' => [

            'attach_files' => [

                'label' => 'Upload fil',

                'modal' => [

                    'heading' => 'Upload fil',

                    'form' => [

                        'file' => [

                            'label' => [
                                'new' => 'Fil',
                                'existing' => 'Erstat fil',
                            ],

                        ],

                        'alt' => [

                            'label' => [
                                'new' => 'Alt-tekst',
                                'existing' => 'Skift alt-tekst',
                            ],

                        ],

                    ],

                ],

            ],

            'custom_block' => [

                'modal' => [

                    'actions' => [

                        'insert' => [
                            'label' => 'Indsæt',
                        ],

                        'save' => [
                            'label' => 'Gem',
                        ],

                    ],

                ],

            ],

            'link' => [

                'label' => 'Link',

                'modal' => [

                    'heading' => 'Link',

                    'form' => [

                        'url' => [
                            'label' => 'URL',
                        ],

                        'should_open_in_new_tab' => [
                            'label' => 'Åbn i ny fane',
                        ],

                    ],

                ],

            ],

        ],

        'tools' => [
            'align_center' => 'Centrér',
            'align_end' => 'Højrejustér',
            'align_justify' => 'Justér',
            'align_start' => 'Venstrejustér',
            'attach_files' => 'Vedhæft filer',
            'blockquote' => 'Blokcitat',
            'bold' => 'Fed',
            'bullet_list' => 'Punktliste',
            'clear_formatting' => 'Ryd formatering',
            'code' => 'Kode',
            'code_block' => 'Kodeblok',
            'h1' => 'Titel',
            'h2' => 'Overskrift 2',
            'h3' => 'Overskrift 3',
            'h4' => 'Overskrift 4',
            'h5' => 'Overskrift 5',
            'h6' => 'Overskrift 6',
            'highlight' => 'Fremhæv',
            'horizontal_rule' => 'Vandret linje',
            'italic' => 'Kursiv',
            'link' => 'Link',
            'ordered_list' => 'Nummereret liste',
            'paragraph' => 'Afsnit',
            'redo' => 'Gentag',
            'strike' => 'Gennemstreget',
            'table' => 'Tabel',
            'underline' => 'Understregning',
            'undo' => 'Fortryd',
        ],

        'uploading_file_message' => 'Uploader fil...',

        'file_attachments_accepted_file_types_message' => 'Uploadede filer skal være af typen: :values.',

        'file_attachments_max_size_message' => 'Uploadede filer må ikke overstige :max kilobytes.',

    ],

    'select' => [

        'actions' => [

            'create_option' => [

                'label' => 'Opret',

                'modal' => [

                    'heading' => 'Opret',

                    'actions' => [

                        'create' => [
                            'label' => 'Opret',
                        ],

                        'create_another' => [
                            'label' => 'Opret & opret endnu en',
                        ],

                    ],

                ],

            ],

            'edit_option' => [

                'label' => 'Rediger',

                'modal' => [

                    'heading' => 'Rediger',

                    'actions' => [

                        'save' => [
                            'label' => 'Gem',
                        ],

                    ],

                ],

            ],

        ],

        'boolean' => [
            'true' => 'Ja',
            'false' => 'Nej',
        ],

        'loading_message' => 'Indlæser...',

        'max_items_message' => 'Kun :count kan vælges.',

        'no_options_message' => 'Ingen muligheder tilgængelige.',

        'no_search_results_message' => 'Ingen muligheder matcher din søgning.',

        'placeholder' => 'Vælg en mulighed',

        'searching_message' => 'Søger...',

        'search_prompt' => 'Begynd at skrive for at søge...',

    ],

    'tags_input' => [

        'actions' => [

            'delete' => [
                'label' => 'Slet',
            ],

        ],

        'placeholder' => 'Nyt tag',

    ],

    'text_input' => [

        'actions' => [

            'copy' => [
                'label' => 'Kopiér',
                'message' => 'Kopieret',
            ],

            'hide_password' => [
                'label' => 'Skjul adgangskode',
            ],

            'show_password' => [
                'label' => 'Vis adgangskode',
            ],

        ],

    ],

    'toggle_buttons' => [

        'boolean' => [
            'true' => 'Ja',
            'false' => 'Nej',
        ],

    ],

];
