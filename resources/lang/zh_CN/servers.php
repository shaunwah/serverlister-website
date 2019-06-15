<?php

return [
    'server' => '服务器',
    'servers' => '服务器',
    'actions' => [
        'create' => '创造',
        'show' => '查看',
        'filter' => '过滤',
        'edit' => '编辑',
        'destroy' => '删除服务器',
        'votes' => [
            'create' => '投票',
        ],
        'reports' => [
            'create' => '报告',
        ],
    ],

    'attributes' => [
        'id' => 'ID',
        'user' => '该作者',
        'name' => '名称',
        'slug' => '简称',
        'game' => '游戏',
        'favicon' => '标识',
        'description' => '描述',
        'rank' => '排名',
        'score' => '比分',
        'ip_address' => 'IP 地址',
        'host' => '主机',
        'port' => '端口',
        'country' => '国家',
        'version' => '版本',
        'type' => '类型',
        'link_website' => '网站',
        'voting_service' => 'Votifier 投票制度',
        'voting_service_enabled' => '启用 Votifier 投票制度',
        'voting_service_token' => '令牌',
        'ping_count' => '查询',
        'vote_count' => '投票',
        'player_count' => '玩家',
        'pings' => [
            'id' => 'ID',
            'user' => '该作者',
            'status' => '状态',
            'rank' => '排名',
            'score' => '比分',
            'description' => '描述',
            'protocol' => '协议',
            'players_total' => '最大在线玩家',
            'players_current' => '在线玩家',
        ],
        'votes' => [
            'id' => 'ID',
            'user' => '该作者',
            'ip_address' => 'IP 地址',
            'username' => '用户名',
        ],
    ],

    'text' => [
        'headers' => [
            'popular_servers' => '顶级服务器',
            'new_servers' => '新服务器',
            'about' => '关于',
            'information' => '选民',
            'players' => '玩家',
            'voting_service' => 'Votifier 投票制度',
            'create' => '创造服务器',
            'edit' => '编辑服务器',
            'votes' => [
                'create' => '投票服务器',
            ],
        ],

        'alerts' => [
            'create_success' => ':server_name 已经被创造了。',
            'edit_success' => '服务器已经被删除了。',
            'votes' => [
                'create_success' => '感谢您的投票。',
                'create_failure' => '您今天已经投过票这台服务器。',
            ],
        ],

        'input' => [
            'optional' => '可选',
            'name_placeholder' => '我的我的世界服务器',
            'create_button' => '创造服务器',
            'edit_button' => '编辑服务器',
            'find_button' => '找到服务器',
            'votes' => [
                'create_button' => '投票给 :server_name',
            ],
            'country_select' => '选择一个国家',
            'version_select' => '选择一个版本',
            'type_select' => '选择一个类型',
        ],

        'help' => [
            'description' => '您可以用 :markdown 来塑造您的描述。',
            'username' => '您的我的世界用户名区分大小写。',
            'voting_service_token' => '您的令牌可以在 \'config.yml\' 的 NuVotifier 夹里找到。',
        ],

        'description_empty' => '没有描述集 :(',
        'status_last_pinged_at' => '最后查询于',
        'status_last_retrieved_at' => '服务器查询在 :carbon',
    ],
];
