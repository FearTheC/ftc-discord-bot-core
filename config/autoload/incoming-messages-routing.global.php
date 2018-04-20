<?php

return [
    'dependencies' => [
        'factories' => [
            'MESSAGE_CREATE' => FTCBotCore\Container\EventHandler\MessageCreate::class,
            'GUILD_CREATE' => FTCBotCore\Container\EventHandler\GuildCreate::class,
        ],
    ],
];
