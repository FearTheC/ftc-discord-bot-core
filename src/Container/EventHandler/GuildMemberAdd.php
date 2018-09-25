<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildMemberAdd as GuildMemberAddInstance;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\UserRepository;

class GuildMemberAdd
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        
        $guildMemberRepository= $container->get(GuildMemberRepository::class);
        $userRepository = $container->get(UserRepository::class);

        return new GuildMemberAddInstance($guildMemberRepository, $userRepository);
    }
    
}
