<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildCreate as GuildCreateInstance;
use FTC\Discord\Db\Core;
use FTCBotCore\Command\Dispatcher;

class GuildCreate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $database = $container->get(Core::class);
        $dispatcher = $container->get(Dispatcher::class);

        return new GuildCreateInstance($database, $dispatcher);
    }
    
}
