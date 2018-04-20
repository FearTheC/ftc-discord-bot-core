<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\Dispatcher as DispatcherInterface;

class Dispatcher
{
    
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['commands'];
        $dispatcher = new DispatcherInterface();

        foreach ($config as $cmdName => $commandClass) {
            $dispatcher->add($cmdName, $container->get($commandClass));
        }
        
        return $dispatcher;
    }
    
}
