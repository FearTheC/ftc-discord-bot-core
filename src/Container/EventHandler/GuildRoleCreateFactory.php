<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildRoleCreate;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;

class GuildRoleCreateFactory
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        
        $repository = $container->get(GuildRoleRepository::class);

        return new GuildRoleCreate($repository);
    }
    
}
