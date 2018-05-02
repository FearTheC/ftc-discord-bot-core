<?php
namespace FTCBotCore\Container\Middleware;

use Psr\Container\ContainerInterface;
use FTCBotCore\Middleware\RouteObserver;

class RouteObserverFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new RouteObserver();
    }
}
