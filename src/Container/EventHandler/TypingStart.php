<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\TypingStart as TypingStartInstance;

class TypingStart
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new TypingStartInstance();
    }
    
}
