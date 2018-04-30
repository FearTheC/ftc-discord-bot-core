<?php

use FTCBotCore;
use FTCBotCore;

return [
    'dependencies' => [
        'invokables' => [
        //             API\Action\PingAction::class => API\Action\PingAction::class,
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => [
            FTCBotCore\Middleware\Index::class => FTCBotCore\Container\Middleware\IndexFactory::class,
        ]
    ],
];
