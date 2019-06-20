<?php

return [
    // Generic Components
    'buttons' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'filter' => 'Filter',
        'report' => 'Report',
        'ping' => 'Ping',
        'vote' => 'Vote',
    ],

    'headers' => [
        'user' => 'User',
        'users' => 'Users',
        'home' => 'Home',
        'reports' => 'Reports',
        'servers' => 'Servers',
        'vote' => 'Vote',
        'support' => 'Support',
        'statistics' => 'Statistics',
        'features' => 'Features',
        'about' => 'About',
        'information' => 'Information',
    ],

    // Context-Specific Components
    'app' => [
        'content' => [
            'author' => 'Crafted with love in Singapore',
            'copyright' => 'Copyright &copy; Zodurus Labs',
        ],
    ],

    'home' => [
        'content' => [
            'call_to_action' => 'Tracking Minecraft servers worldwide, 24/7.',
            'call_to_action_button' => 'Find Servers',
            'last_pinged_at' => 'Server information last retrieved :time_difference',
        ],
    ],

    'user' => [
        'headers' => [
            'login' => 'Login',
            'logout' => 'Logout',
            'register' => 'Register',
            'register_alt' => 'Register Account',
            'dashboard' => 'Dashboard',
            'settings' => 'Settings',
            'account' => 'Account',
            'security' => 'Security',
            'console' => 'Console',
            'statistics' => 'Your Statistics',
            'servers' => 'Your Servers',
        ],
        'content' => [
            'welcome' => 'Welcome back, :username.',
            'forgot_password' => 'Forgot Password?',
        ],
    ],

    'reports' => [
        'headers' => [
            'create' => 'Create Report',
            'view' => 'Report',
            'edit' => 'Edit Report',
        ],
        'content' => [
            'information' => 'You are reporting :entity_name for abuse of ServerLister\'s terms of service and/or rules.',
            'server_disclaimer' => 'ServerLister and its staff cannot resolve issues regarding internal server matters. In such cases, you are advised to communicate directly with the server staff to resolve your issues.',
        ],
    ],

    'servers' => [
        'headers' => [
            'create' => 'Create Server',
            'edit' => 'Edit Server',
            'top' => 'Top Servers',
            'new' => 'New Servers',
            'voters' => 'Voters',
            'voting_service' => 'Votifier',
            'statistics' => [
                'max_players' => 'Max',
                'average_players' => 'Average',
                'total_votes' => 'Total',
            ],
        ],
        'content' => [
            'voting_service_information' => 'The <a href="https://www.spigotmc.org/resources/nuvotifier.13449/" target="_blank">Votifier server plugin</a> lets you reward your players in-game in return for voting for your server. You are highly recommended to enable it.',
            'empty_server' => 'No servers. Create one?',
            'empty_description' => 'No description set. :(',
            'last_pinged_at' => 'Last pinged at',
        ],
    ],

    'server_verifications' => [
        'headers' => [
            'create' => 'Verify Server',
        ],
    ],

    'server_votes' => [
        'headers' => [
            'create' => 'Vote Server',
            'create_alt' => 'Vote for :server_name',
            'new' => 'New Servers',
            'voters' => 'Voters',
        ],
        'content' => [
            'receive_rewards' => 'You may receive a reward for voting.',
        ],
    ],

    'support' => [
        'headers' => [
            'privacy_policy' => 'Privacy Policy',
            'terms_of_service' => 'Terms of Service',
            'rules' => 'Rules',
        ],
    ],
];
