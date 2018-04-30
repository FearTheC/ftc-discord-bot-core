<?php
namespace FTC\Container\Action;

use Psr\Container\ContainerInterface;
use FTCBotCore\Middleware\Index;

class IndexFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Index($reaper);
    }
}