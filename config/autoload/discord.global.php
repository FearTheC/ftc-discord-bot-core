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
            FTC\Discord\Model\Aggregate\GuildRepository::class =>
                FTC\Discord\Db\Postgresql\Container\GuildRepository::class,
            FTC\Discord\Model\UserRepository::class =>
                FTC\Discord\Db\Postgresql\Factory\UserRepository::class,
            FTC\Discord\Model\GuildRoleRepository::class =>
                FTC\Discord\Db\Postgresql\Factory\GuildRoleRepository::class,
            FTC\Discord\Model\GuildMemberRepository::class =>
                FTC\Discord\Db\Postgresql\Factory\GuildMemberRepository::class,
        ],
    ],
];
