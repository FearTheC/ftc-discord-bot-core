<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\ChangeMemberRole as ChangeMemberRoleInstance;
use FTCBotCore\Db\Core;

class ChangeMemberRole
{
    
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(Core::class);
        
        return new ChangeMemberRoleInstance($database);
    }
    
}
