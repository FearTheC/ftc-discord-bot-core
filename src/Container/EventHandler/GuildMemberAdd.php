<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildMemberAdd as GuildMemberAddInstance;
use FTCBotCore\Db\Core;
use FTCBotCore\Db\DbCacheInterface;
use FTCBotCore\Command\Dispatcher;

class GuildMemberAdd
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $database = $container->get(Core::class);
        $cache = $container->get(DbCacheInterface::class);

        return new GuildMemberAddInstance($database, $cache);
    }
    
}
