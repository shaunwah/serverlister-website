<?php

return [
    // Generic Strings
    'labels' => [
        'optional' => '可選項目',
        'required' => '必填項目',
    ],

    // Context-Specific Strings
    'user' => [
        'buttons' => [
            'create' => '註冊賬戶',
            'edit' => '更新賬戶',
            'delete' => '關閉賬戶',
            'login' => '登錄',
        ],
    ],

    'reports' => [
        'help' => [
            'description' => '詳細說明問題幫助我們更快地解決問題。'
        ],
        'buttons' => [
            'create' => '提交報告',
            'edit' => '更新報告',
            'delete' => '刪除報告',
        ],
    ],

    'servers' => [
        'help' => [
            'description' => '您可以用 <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">Markdown</a> 幫助格式化您的描述。',
            'voting_service_token' => '您的令牌可以在 \'config.yml\' 從 NuVotifier 文件夾找到。'
        ],
        'buttons' => [
            'create' => '創造服務器',
            'edit' => '更新服務器',
            'delete' => '刪除服務器',
        ],
        'options' => [
            'country' => '選擇一個國家',
            'version' => '選擇一個版本',
            'type' => '選擇一個類型',
        ],
    ],

    'server_votes' => [
        'help' => [
            'username' => '您的我的世界用戶名區分大小寫。',
        ],
        'buttons' => [
            'create' => '投票給 :server_name',
        ],
    ],
];
