<?php

return [
    'discord' => [
        'token' => 'NDMyMjg5NTU3MzA4NzY4MjY2.DbVtTA.H45OL_4BNlX8v6LsG81kd6F4BLY/',
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
        ],
    ],
];
