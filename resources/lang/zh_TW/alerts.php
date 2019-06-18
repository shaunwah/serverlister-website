<?php

return [
    'user' => [
        'edit' => [
            'success' => '您的賬戶已經創造。',
            'failure' => '您的賬戶未能創造。 請再試一次。',
        ],
    ],
    'reports' => [
        'create' => [
            'success' => '您的報告已經提交。 謝謝。',
            'failure' => '您的報告未能提交。 請再試一次。',
        ],
        'edit' => [
            'success' => '您的報告已經更新。',
            'failure' => '您的報告未能更新。 請再試一次。',
        ],
    ],

    'servers' => [
        'create' => [
            'success' => ':server_name 已經創造。',
            'failure' => ':server_name 未能創造。 請再試一次。',
        ],
        'edit' => [
            'success' => '您的服務器已經更新。',
            'failure' => '您的服務器未能更新。 請再試一次。',
        ],
        'delete' => [
            'success' => '您的服務器已經刪除。',
            'failure' => '您的服務器未能刪除。 請再試一次。',
        ],
    ],

    'server_pings' => [
        'create' => [
            'success' => '您的服務器已經成功查詢。',
            'failure' => '您的服務器未能成功查詢。',
        ],
    ],

    'server_votes' => [
        'create' => [
            'success' => '感謝您的投票。 您明天可以再投票。',
            'failure' => '您今天已經投了票。 請明天再試一次。',
        ],
    ],

    'services' => [
        'recaptcha' => [
            'success' => '您的 reCAPTCHA 請求已經通過。',
            'failure' => '您的 reCAPTCHA 請求未能通過。',
        ],
    ],
];
