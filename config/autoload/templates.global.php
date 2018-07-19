<?php

return [
    'dependencies' => [
        'factories' => [
            \Zend\Expressive\FinalHandler::class => \Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,
            \Zend\Expressive\Template\TemplateRendererInterface::class => \Zend\Expressive\ZendView\ZendViewRendererFactory::class,
            \Zend\View\HelperPluginManager::class => \Zend\Expressive\ZendView\HelperPluginManagerFactory::class,
            \Zend\Expressive\Helper\ServerUrlMiddleware::class => \Zend\Expressive\Helper\ServerUrlMiddlewareFactory::class,
            \Zend\Expressive\Helper\UrlHelper::class => \Zend\Expressive\Helper\UrlHelperFactory::class,
        ],
        'invokables' => [
            \Zend\Expressive\Helper\ServerUrlHelpe::class => \Zend\Expressive\Helper\ServerUrlHelpe::class,
        ],
    ],

    'templates' => [
        'layout' => 'app::layout',
        'map' => [
            'error/error'    => 'templates/error/error.phtml',
            'error/404'      => 'templates/error/404.phtml',
            //html templates
            'app::layout' => 'templates/layout/layout.phtml',
            'app::menu' => 'templates/layout/menu.phtml',
            'page::hero' => 'templates/action/hero.phtml',
            'app::user-menu' => 'templates/layout/user-menu.phtml'
        ],
        'paths' => [
            'action' => ['templates/action'],
            'mail' => ['templates/mail'],
            'app'    => ['templates/app'],
            'layout' => ['templates/layout'],
            'error'  => ['templates/error'],
        ],
    ],
    'view_helpers' => [
        'invokables' => [
        ],
        'factories' => [
            'mainMenu' => \FTC\Container\View\Helper\MainMenuFactory::class,
        ],
    ],
];