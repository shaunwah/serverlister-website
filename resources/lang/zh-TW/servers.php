<?php

return [
    'server' => '服務器',
    'servers' => '服務器',
    'actions' => [
        'create' => '創造',
        'show' => '查看',
        'filter' => '過濾',
        'edit' => '編輯',
        'destroy' => '刪除服務器',
        'votes' => [
            'create' => '投票',
        ],
        'reports' => [
            'create' => '報告',
        ],
    ],

    'attributes' => [
        'id' => 'ID',
        'user' => '該作者',
        'name' => '名稱',
        'slug' => '簡稱',
        'game' => '遊戲',
        'favicon' => '標識',
        'description' => '描述',
        'rank' => '排名',
        'score' => '比分',
        'ip_address' => 'IP 地址',
        'host' => '主機',
        'port' => '端口',
        'country' => '國家',
        'version' => '版本',
        'type' => '類型',
        'link_website' => '網站',
        'voting_service' => 'Votifier 投票制度',
        'voting_service_enabled' => '啟用 Votifier 投票制度',
        'voting_service_token' => '令牌',
        'ping_count' => '查詢',
        'vote_count' => '投票',
        'player_count' => '玩家',
        'pings' => [
            'id' => 'ID',
            'user' => '該作者',
            'status' => '狀態',
            'rank' => '排名',
            'score' => '比分',
            'description' => '描述',
            'protocol' => '協議',
            'players_total' => '最大在線玩家',
            'players_current' => '在線玩家',
        ],
        'votes' => [
            'id' => 'ID',
            'user' => '該作者',
            'ip_address' => 'IP 地址',
            'username' => '用戶名',
        ],
    ],

    'text' => [
        'headers' => [
            'popular_servers' => '頂級服務器',
            'new_servers' => '新服務器',
            'about' => '關於',
            'information' => '選民',
            'players' => '玩家',
            'voters' => '選民',
            'voting_service' => 'Votifier 投票制度',
            'create' => '創造服務器',
            'edit' => '編輯服務器',
            'votes' => [
                'create' => '投票服務器',
            ],
        ],

        'alerts' => [
            'create_success' => ':server_name 已經被創造了。',
            'edit_success' => '服務器已經被刪除了。',
            'votes' => [
                'create_success' => '感謝您的投票。',
                'create_failure' => '您今天已經投過票這台服務器。',
            ],
        ],

        'input' => [
            'optional' => '可選',
            'name_placeholder' => '我的我的世界服務器',
            'create_button' => '創造服務器',
            'edit_button' => '編輯服務器',
            'find_button' => '找到服務器',
            'votes' => [
                'create_button' => '投票給 :server_name',
            ],
            'country_select' => '選擇一個國家',
            'version_select' => '選擇一個版本',
            'type_select' => '選擇一個類型',
        ],

        'help' => [
            'description' => '您可以用 :markdown 來塑造您的描述。',
            'username' => '您的我的世界用戶名區分大小寫。',
            'voting_service_token' => '您的令牌可以在 \'config.yml\' 的 NuVotifier 夾裡找到。',
        ],

        'description_empty' => '沒有描述集。 :(',
        'status_last_pinged_at' => '最後查詢於',
        'status_last_retrieved_at' => '服務器查詢在 :carbon',
    ],
];
