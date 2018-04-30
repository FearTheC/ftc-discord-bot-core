<?php

return [
    'dependencies' => [
        'factories' => [
            \Zend\Expressive\Application::class => \Zend\Expressive\Container\ApplicationFactory::class,
        ],
//         'delegators' => [
//             \Zend\Expressive\Application::class => [
//                 \FTCBotCore\Container\PipelineAndRoutesDelegator::class,
//             ],
//         ],
    ],
];
