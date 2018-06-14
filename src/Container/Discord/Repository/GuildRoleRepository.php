<?php
namespace FTCBotCore\Container\Discord\Repository;

use Psr\Container\ContainerInterface;
use FTCBotCore\Discord\Repository\GuildRoleRepository as GuildRoleRepositoryImp;
use FTCBotCore\Db\Core;

class GuildRoleRepository
{
    
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(Core::class);

        return new GuildRoleRepositoryImp($database);
    }
    
}
