<?php

return [
    'user' => [
        'edit' => [
            'success' => 'Your account has been updated.',
            'failure' => 'Your account has not been updated. Please try again.',
        ],
    ],
    'reports' => [
        'create' => [
            'success' => 'Your report has been submitted. Thank you.',
            'failure' => 'Your report has not been submitted. Please try again.',
        ],
        'edit' => [
            'success' => 'Your report has been updated.',
            'failure' => 'Your report has not been updated. Please try again.',
        ],
    ],

    'servers' => [
        'create' => [
            'success' => ':server_name has been created.',
            'failure' => ':server_name has not been created. Please try again.',
        ],
        'edit' => [
            'success' => 'Your server has been updated.',
            'failure' => 'Your server has not been updated. Please try again.',
        ],
        'delete' => [
            'success' => ':server_name has been deleted.',
            'failure' => ':server_name has not been deleted. Please try again.',
        ],
    ],

    'server_verifications' => [
        'create' => [
            'success' => 'The server has been verified successfully.',
            'failure' => 'The server failed to be verified. Please try again.',
        ],
    ],

    'server_pings' => [
        'create' => [
            'success' => 'Your server has been pinged successfully.',
            'failure' => 'Your server failed to be pinged.',
        ],
    ],

    'server_votes' => [
        'create' => [
            'success' => 'Thank you for your vote. You may vote again tomorrow.',
            'failure' => 'You have already voted today. Please try again :time_difference.',
        ],
    ],

    'services' => [
        'recaptcha' => [
            'success' => 'Your reCAPTCHA request has been validated.',
            'failure' => 'Your reCAPTCHA request failed to validate.',
        ],
    ],
];
