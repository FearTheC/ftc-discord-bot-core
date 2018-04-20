<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildCreate as GuildCreateInstance;
use FTCBotCore\Db\Core;

class GuildCreate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $database = $container->get(Core::class);

        return new GuildCreateInstance($database);
    }
    
}
