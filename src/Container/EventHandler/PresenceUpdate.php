<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\PresenceUpdate as PresenceUpdateInstance;
use FTC\Discord\Db\Core;
use FTCBotCore\Db\DbCacheInterface;

class PresenceUpdate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $database = $container->get(Core::class);
        $cache = $container->get(DbCacheInterface::class);

        return new PresenceUpdateInstance($database, $cache);
    }
    
}
