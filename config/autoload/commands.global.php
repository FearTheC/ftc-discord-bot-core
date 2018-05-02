<?php

return [
    'commands' => [
        'count' => FTCBotCore\Command\CountMembers::class,
        'role' => FTCBotCore\Command\ChangeMemberRole::class,
        'removeMemberRole' => FTCBotCore\Command\RemoveMemberRole::class,
    ],
    'dependencies' => [
        'factories' => [
            FTCBotCore\Command\Dispatcher::class => FTCBotCore\Container\Command\Dispatcher::class,
            FTCBotCore\Command\CountMembers::class => FTCBotCore\Container\Command\CountMembers::class,
            FTCBotCore\Command\ChangeMemberRole::class => FTCBotCore\Container\Command\ChangeMemberRole::class,
            FTCBotCore\Command\CreateGuildMember::class => FTCBotCore\Container\Command\CreateGuildMember::class,
            FTCBotCore\Command\RemoveMemberRole::class => FTCBotCore\Container\Command\RemoveMemberRole::class,
        ]
    ],
];
