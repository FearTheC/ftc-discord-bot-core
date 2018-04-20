<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\CountMembers as CountMembersInstance;
use FTCBotCore\Db\Core;

class CountMembers
{
    
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(Core::class);
        
        return new CountMembersInstance($database);
    }
    
}
