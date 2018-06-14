<?php

return [
    'discord' => [
        'http' => [
            'base_url' => 'https://discordapp.com/api/v6',
            'defaults' => [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]
        ]
    ],
    'dependencies' => [
        'factories' => [
            'discord-http-client' => FTCBotCore\Container\Discord\HttpClient::class,
            FTCBotCore\Discord\Model\GuildRoleRepository::class =>
            FTCBotCore\Container\Discord\Repository\GuildRoleRepository::class,
            FTCBotCore\Discord\Model\GuildMemberRepository::class =>
            FTCBotCore\Container\Discord\Repository\GuildMemberRepository::class,
        ],
    ],
];
