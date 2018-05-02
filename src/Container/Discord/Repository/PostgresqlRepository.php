<?php
namespace FTCBotCore\Container\Discord\Repository;

use Psr\Container\ContainerInterface;
use FTCBotCore\Discord\Repository\GuildMemberRepository as GuildMemberRepositoryImp;

class GuildMemberReposito
{
    
    public function __invoke(ContainerInterface $container)
    {
        $database = $container->get(Core::class);

        return new GuildMemberRepositoryImp($database);
    }
    
}
