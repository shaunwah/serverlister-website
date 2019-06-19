<?php

return [
    // Generic Strings
    'labels' => [
        'optional' => 'optional',
        'required' => 'required',
    ],

    // Context-Specific Strings
    'user' => [
        'buttons' => [
            'create' => 'Register Account',
            'edit' => 'Update Account',
            'delete' => 'Deactivate Account',
            'login' => 'Login',
        ],
    ],

    'reports' => [
        'help' => [
            'description' => 'Describing the issue in detail helps us resolve it as fast as possible.'
        ],
        'buttons' => [
            'create' => 'Submit Report',
            'edit' => 'Update Report',
            'delete' => 'Delete Report',
        ],
    ],

    'servers' => [
        'help' => [
            'description' => 'You may use <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">Markdown</a> to beautify your description.',
            'voting_service_token' => 'Your token may be found in \'config.yml\' of your NuVotifier folder.'
        ],
        'buttons' => [
            'create' => 'Create Server',
            'edit' => 'Update Server',
            'delete' => 'Delete Server',
        ],
        'options' => [
            'country' => 'select a country',
            'version' => 'select a version',
            'type' => 'select a type',
        ],
    ],

    'server_verifications' => [
        'buttons' => [
            'create' => 'Verify Server',
        ],
    ],

    'server_votes' => [
        'help' => [
            'username' => 'Your Minecraft username is cAsE-sEnSiTiVe.',
        ],
        'buttons' => [
            'create' => 'Vote for :server_name',
        ],
    ],
];
