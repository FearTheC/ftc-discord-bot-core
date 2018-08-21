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
            \FTC\Discord\Model\Aggregate\GuildRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\GuildRepository::class,
            \FTC\Discord\Model\Aggregate\UserRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\UserRepository::class,
            \FTC\Discord\Model\Aggregate\GuildRoleRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\GuildRoleRepository::class,
            \FTC\Discord\Model\Aggregate\GuildMemberRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\GuildMemberRepository::class,
            \FTC\Discord\Model\Aggregate\GuildChannelRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\GuildChannelRepository::class,
            
            \FTC\Discord\Model\Channel\DMChannel\DMRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\DMRepositoryFactory::class,
            \FTC\Discord\Model\Channel\DMChannel\GroupDMRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\GroupDMRepositoryFactory::class,
            \FTC\Discord\Model\Repository\VocalPresenceRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\VocalPresenceRepository::class,
            
            \FTC\Discord\Model\Aggregate\GuildMessageRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\GuildMessageRepository::class,
            \FTC\Discord\Model\Aggregate\GuildWebsitePermissionRepository::class =>
               \FTC\Discord\Db\Postgresql\Container\GuildWebsitePermissionRepository::class,
            \FTC\Discord\Model\Aggregate\ErrorMessageRepository::class =>
                \FTC\Discord\Db\Postgresql\Container\ErrorMessageRepository::class,
            /**
             * Domain services
             */
            \FTC\Discord\Model\Service\GuildCreation::class => \FTC\Discord\Container\Model\Service\GuildCreationFactory::class,
            \FTC\Discord\Model\Service\VocalPresenceService::class => \FTC\Discord\Container\Model\Service\VocalPresenceServiceFactory::class,
        ],
    ],
];
