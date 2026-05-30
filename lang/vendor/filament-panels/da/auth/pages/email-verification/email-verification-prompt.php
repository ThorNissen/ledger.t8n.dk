<?php

return [

    'title' => 'Bekræft din e-mailadresse',

    'heading' => 'Bekræft din e-mailadresse',

    'actions' => [

        'resend_notification' => [
            'label' => 'Send igen',
        ],

    ],

    'messages' => [
        'notification_not_received' => 'Har du ikke modtaget e-mailen vi sendte?',
        'notification_sent' => 'Vi har sendt en e-mail til :email med instruktioner til, hvordan du bekræfter din e-mailadresse.',
    ],

    'notifications' => [

        'notification_resent' => [
            'title' => 'Vi har gensendt e-mailen.',
        ],

        'notification_resend_throttled' => [
            'title' => 'For mange gensendingsforsøg',
            'body' => 'Prøv venligst igen om :seconds sekunder.',
        ],

    ],

];
