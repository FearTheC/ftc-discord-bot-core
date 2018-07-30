<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildMemberUpdate as GuildMemberUpdateInstance;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;

class GuildMemberUpdate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $memberRepository = $container->get(GuildMemberRepository::class);

        return new GuildMemberUpdateInstance($memberRepository);
    }
    
}
