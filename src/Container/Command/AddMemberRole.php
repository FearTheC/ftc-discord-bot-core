<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\AddMemberRole as AddMemberRoleInstance;
use FTC\Discord\Model\GuildMemberRepository;
use FTC\Discord\Model\GuildRoleRepository;

class AddMemberRole
{
    
    public function __invoke(ContainerInterface $container)
    {
        $membreRepository = $container->get(GuildMemberRepository::class);
        $roleRepository = $container->get(GuildRoleRepository::class);
        $client = $container->get('discord-http-client');
        
        return new AddMemberRoleInstance($membreRepository, $roleRepository, $client);
    }
    
}
