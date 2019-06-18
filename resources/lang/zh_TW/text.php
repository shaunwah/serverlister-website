<?php

return [
    // Generic Components
    'buttons' => [
        'create' => '創造',
        'edit' => '更新',
        'delete' => '刪除',
        'filter' => '過濾',
        'report' => '報告',
        'ping' => '查詢',
        'vote' => '投票',
    ],

    'headers' => [
        'user' => '用戶',
        'users' => '用戶',
        'home' => '主頁',
        'reports' => '報告',
        'servers' => '服務器',
        'vote' => '投票',
        'support' => '援助',
        'statistics' => '統計',
        'features' => '功能',
        'about' => '關於',
        'information' => '信息',
    ],

    // Context-Specific Components
    'app' => [
        'content' => [
            'author' => '在新加坡充滿愛意',
            'copyright' => '版權 &copy; Zodurus Labs',
        ],
    ],

    'home' => [
        'content' => [
            'call_to_action' => '全球尋找我的世界服務器，24/7。',
            'call_to_action_button' => '尋找服務器',
            'last_pinged_at' => '服務器信息最後最後查詢:time_difference',
        ],
    ],

    'user' => [
        'headers' => [
            'login' => '登錄',
            'logout' => '登出',
            'register' => '註冊',
            'register_alt' => '註冊賬戶',
            'dashboard' => '用戶面板',
            'settings' => '設定',
            'account' => '賬戶',
            'security' => '安全',
            'console' => '用戶面板',
            'statistics' => '您的統計',
            'servers' => '您的服務器',
        ],
        'content' => [
            'welcome' => '歡迎回來，:username。',
            'forgot_password' => '忘記密碼？',
        ],
    ],

    'reports' => [
        'headers' => [
            'create' => '創造報告',
            'view' => '報告',
            'edit' => '更新報告',
        ],
        'content' => [
            'information' => '你現在報告 :entity_name 濫用 ServerLister 的服務條款和/或規則。',
            'server_disclaimer' => 'ServerLister 和員工無法解決您的內部問題。 建議您聯繫服務器工作人員以獲得進一步的幫助。',
        ],
    ],

    'servers' => [
        'headers' => [
            'create' => '創造服務器',
            'edit' => '更新服務器',
            'top' => '頂級服務器',
            'new' => '新服務器',
            'voters' => '選民',
            'voting_service' => 'Votifier 投票服務',
            'statistics' => [
                'max_players' => '最多',
                'average_players' => '平均',
            ],
        ],
        'content' => [
            'voting_service_information' => '<a href="https://www.spigotmc.org/resources/nuvotifier.13449/" target="_blank">Votifier 投票服務服務器插件</a>讓你獎勵玩家以換取投票。 強烈建議您啟用。',
            'empty_server' => '沒有服務器。 創造一個新的？',
            'empty_description' => '描述是空的。 :(',
            'last_pinged_at' => '最後查詢',
        ],
    ],

    'server_votes' => [
        'headers' => [
            'create' => '服務器投票',
            'create_alt' => '投票給 :server_name',
            'voters' => '選民',
        ],
    ],

    'support' => [
        'headers' => [
            'privacy_policy' => '隱私政策',
            'terms_of_service' => '服務條款',
            'rules' => '規則',
        ],
    ],
];
