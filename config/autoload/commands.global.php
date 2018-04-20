<?php

return [
    'commands' => [
        'count' => FTCBotCore\Command\CountMembers::class,
        'mmm' => FTCBotCore\Command\CountMembers::class,
    ],
    'dependencies' => [
        'factories' => [
            FTCBotCore\Command\Dispatcher::class => FTCBotCore\Container\Command\Dispatcher::class,
            FTCBotCore\Command\CountMembers::class => FTCBotCore\Container\Command\CountMembers::class,
        ]
    ],
];
