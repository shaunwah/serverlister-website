<?php

return [
    'server' => 'Server',
    'servers' => 'Servers',
    'actions' => [
        'create' => 'Create',
        'show' => 'View',
        'filter' => 'Filter by',
        'edit' => 'Edit',
        'destroy' => 'Delete Server',
        'votes' => [
            'create' => 'Vote',
        ],
        'reports' => [
            'create' => 'Report',
        ],
    ],

    'attributes' => [
        'id' => 'ID',
        'user' => 'Creator',
        'name' => 'Name',
        'slug' => 'Slug',
        'game' => 'Game',
        'favicon' => 'Favicon',
        'description' => 'Description',
        'rank' => 'Rank',
        'score' => 'Score',
        'ip_address' => 'IP Address',
        'host' => 'Host',
        'port' => 'Port',
        'country' => 'Country',
        'version' => 'Version',
        'type' => 'Type',
        'link_website' => 'Website',
        'voting_service' => 'Votifier',
        'voting_service_enabled' => 'Enable Votifier',
        'voting_service_token' => 'Token',
        'ping_count' => 'Pings',
        'vote_count' => 'Votes',
        'player_count' => 'Players',
        'pings' => [
            'id' => 'ID',
            'user' => 'User',
            'status' => 'Status',
            'rank' => 'Rank',
            'score' => 'Score',
            'description' => 'Description',
            'protocol' => 'Protocol',
            'players_total' => 'Total Players',
            'players_current' => 'Current Players',
        ],
        'votes' => [
            'id' => 'ID',
            'user' => 'Voter',
            'ip_address' => 'IP Address',
            'username' => 'Username',
        ],
    ],

    'text' => [
        'headers' => [
            'popular_servers' => 'Top Servers',
            'new_servers' => 'New Servers',
            'about' => 'About',
            'information' => 'Information',
            'players' => 'Players',
            'voters' => 'Voters',
            'voting_service' => 'Votifier',
            'create' => 'Create Server',
            'edit' => 'Edit Server',
            'votes' => [
                'create' => 'Vote Server',
            ],
        ],

        'alerts' => [
            'create_success' => ':server_name has been successfully created.',
            'edit_success' => 'The server has been successfully updated.',
            'votes' => [
                'create_success' => 'Thank you for your vote.',
                'create_failure' => 'You have already voted for this server today.',
            ],
        ],

        'input' => [
            'optional' => 'optional',
            'name_placeholder' => 'My Minecraft Server',
            'create_button' => 'Create Server',
            'edit_button' => 'Edit Server',
            'find_button' => 'Find Servers',
            'votes' => [
                'create_button' => 'Vote for :server_name',
            ],
            'country_select' => 'select a country',
            'version_select' => 'select a version',
            'type_select' => 'select a type',
        ],

        'help' => [
            'description' => 'You may use :markdown to stylise your description.',
            'username' => 'Your Minecraft username is cAsE-sEnSiTiVe.',
            'voting_service_token' => 'Your token can be found in \'config.yml\' of your NuVotifier folder.',
        ],

        'description_empty' => 'No description set. :(',
        'status_last_pinged_at' => 'Last pinged at',
        'status_last_retrieved_at' => 'Server information last retrieved :carbon',
    ],
];
