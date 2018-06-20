<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\RemoveMemberRole as RemoveMemberRoleInstance;
use FTC\Discord\Db\Core;

class RemoveMemberRole
{
    
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(Core::class);
        
        return new RemoveMemberRoleInstance($database);
    }
    
}
