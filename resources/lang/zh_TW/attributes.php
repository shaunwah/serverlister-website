<?php

return [
    'language' => '中文（繁體）',

    'users' => [
        'username' => '用戶名',
        'email' => '電子郵件',
        'timezone' => '時區',
        'password' => '密碼',
        'password_confirmation' => '確認',
        'password_current' => '當前',
        'password_new' => '新',
        'remember_me' => '記住賬號'
    ],

    'reports' => [
        'entity' => '實體',
        'issue' => '問題',
        'description' => '描述',
        'status' => '狀態',
        'created_by' => '記者',
        'created_at' => '創造在',
        'updated_at' => '更新在',
    ],

    'servers' => [
        'name' => '名稱',
        'slug' => '簡稱',
        'game' => '游戲',
        'games' => [
            'minecraft_java' => '我的世界',
        ],
        'favicon' => '圖標',
        'description' => '描述',
        'rank' => '等級',
        'score' => '評分',
        'host' => '主機',
        'port' => '港口',
        'country' => '國家',
        'version' => '版本',
        'type' => '類型',
        'link_website' => '網站',
        'voting_service_enabled' => '啟用 Votifier 投票服務',
        'voting_service_token' => '令牌',
        'pings' => '查詢',
        'votes' => '票',
        'created_by' => '作者',
        'created_at' => '創造在',
        'updated_at' => '更新在',
    ],

    'server_pings' => [
        'status' => '狀態',
        'description' => 'MOTD',
        'protocol' => '協議',
        'players' => '玩家',
        'players_total' => '總玩家',
        'players_current' => '當前玩家',
        'created_by' => '作者',
    ],

    'server_votes' => [
        'ip_address' => 'IP 地址',
        'username' => '用戶名',
        'created_by' => '選民',
    ],
];
