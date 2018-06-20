<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\CountMembers as CountMembersInstance;
use FTC\Discord\Db\Core;

class CountMembers
{
    
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(Core::class);
        $client = $container->get('discord-http-client');
        
        return new CountMembersInstance($database, $client);
    }
    
}
