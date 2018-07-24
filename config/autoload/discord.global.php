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
            /**
             * Repositories
             */
            FTC\Discord\Model\Aggregate\GuildRepository::class =>
                FTC\Discord\Db\Postgresql\Container\GuildRepository::class,
            FTC\Discord\Model\Aggregate\UserRepository::class =>
                FTC\Discord\Db\Postgresql\Container\UserRepository::class,
            FTC\Discord\Model\Aggregate\GuildRoleRepository::class =>
                FTC\Discord\Db\Postgresql\Container\GuildRoleRepository::class,
            FTC\Discord\Model\Aggregate\GuildMemberRepository::class =>
                FTC\Discord\Db\Postgresql\Container\GuildMemberRepository::class,
            FTC\Discord\Model\Aggregate\GuildChannelRepository::class =>
                FTC\Discord\Db\Postgresql\Container\GuildChannelRepository::class,
            FTC\Discord\Model\Aggregate\GuildWebsitePermissionRepository::class =>
                FTC\Discord\Db\Postgresql\Container\GuildWebsitePermissionRepository::class,
            /**
             * Domain services
             */
            \FTC\Discord\Model\Service\GuildCreation::class => \FTC\Discord\Container\Model\Service\GuildCreationFactory::class
        ],
    ],
];
