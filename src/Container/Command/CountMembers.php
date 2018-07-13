<?php
namespace FTCBotCore\Container\Command;


use Psr\Container\ContainerInterface;
use FTCBotCore\Command\CountMembers as CountMembersInstance;
use FTC\Discord\Db\Core;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;

class CountMembers
{
    
    public function __invoke(ContainerInterface $container)
    {
        $repository = $container->get(GuildMemberRepository::class);
        $guildRoleRepository = $container->get(GuildRoleRepository::class);
        $client = $container->get('discord-http-client');
        
        return new CountMembersInstance($repository, $guildRoleRepository, $client);
    }
    
}
