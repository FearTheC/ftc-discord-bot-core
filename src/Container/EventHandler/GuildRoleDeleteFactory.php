<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;
use FTCBotCore\EventHandler\GuildRoleDelete;

class GuildRoleDeleteFactory
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        
        $repository = $container->get(GuildRoleRepository::class);

        return new GuildRoleDelete($repository);
    }
    
}
