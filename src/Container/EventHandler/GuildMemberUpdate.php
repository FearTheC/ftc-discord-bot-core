<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildMemberUpdate as GuildMemberUpdateInstance;
use FTCBotCore\Db\Core;
use FTCBotCore\Db\DbCacheInterface;

class GuildMemberUpdate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $database = $container->get(Core::class);
        $cache = $container->get(DbCacheInterface::class);

        return new GuildMemberUpdateInstance($database, $cache);
    }
    
}
