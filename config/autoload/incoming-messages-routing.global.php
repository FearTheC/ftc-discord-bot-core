<?php

return [
    'dependencies' => [
        'factories' => [
            'MESSAGE_CREATE' => FTCBotCore\Container\EventHandler\MessageCreate::class,
            'GUILD_CREATE' => FTCBotCore\Container\EventHandler\GuildCreate::class,
            'PRESENCE_UPDATE' => FTCBotCore\Container\EventHandler\PresenceUpdate::class,
            'GUILD_MEMBER_UPDATE' => FTCBotCore\Container\EventHandler\GuildMemberUpdate::class,
            'GUILD_MEMBER_ADD' => FTCBotCore\Container\EventHandler\GuildMemberAdd::class,
        ],
    ],
];
