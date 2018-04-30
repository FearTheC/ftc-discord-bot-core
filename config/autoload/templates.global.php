<?php

use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\ServerUrlMiddlewareFactory;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Helper\UrlHelperFactory;

return [
    'dependencies' => [
        'factories' => [
            Zend\Expressive\FinalHandler::class => Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,
            Zend\Expressive\Template\TemplateRendererInterface::class => Zend\Expressive\ZendView\ZendViewRendererFactory::class,
            Zend\View\HelperPluginManager::class => Zend\Expressive\ZendView\HelperPluginManagerFactory::class,
            ServerUrlMiddleware::class => ServerUrlMiddlewareFactory::class,
            UrlHelper::class => UrlHelperFactory::class,
        ],
        'invokables' => [
            ServerUrlHelper::class => ServerUrlHelper::class,
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