<?php

return [
    'dependencies' => [
        'factories' => [
            'MESSAGE_CREATE' => FTCBotCore\Container\EventHandler\MessageCreate::class,
            'GUILD_CREATE' => FTCBotCore\Container\EventHandler\GuildCreate::class,
            'PRESENCE_UPDATE' => FTCBotCore\Container\EventHandler\PresenceUpdate::class,
            'GUILD_MEMBER_UPDATE' => FTCBotCore\Container\EventHandler\GuildMemberUpdate::class,
            'GUILD_MEMBER_ADD' => FTCBotCore\Container\EventHandler\GuildMemberAdd::class,
            'GUILD_ROLE_CREATE' => FTCBotCore\Container\EventHandler\GuildRoleCreateFactory::class,
            'GUILD_ROLE_UPDATE' => FTCBotCore\Container\EventHandler\GuildRoleUpdateFactory::class,
            'GUILD_ROLE_DELETE' => FTCBotCore\Container\EventHandler\GuildRoleDeleteFactory::class,
            'CHANNEL_CREATE' => FTCBotCore\Container\EventHandler\ChannelCreateFactory::class,
            'CHANNEL_UPDATE' => FTCBotCore\Container\EventHandler\ChannelUpdateFactory::class,
            'CHANNEL_DELETE' => FTCBotCore\Container\EventHandler\ChannelDeleteFactory::class,
            'VOICE_STATE_UPDATE' => FTCBotCore\Container\EventHandler\VoiceStateUpdateFactory::class,
        ],
    ],
];
