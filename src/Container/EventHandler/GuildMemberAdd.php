<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildMemberAdd as GuildMemberAddInstance;
use FTC\Discord\Model\GuildMemberRepository;

class GuildMemberAdd
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        
        $repository = $container->get(GuildMemberRepository::class);

        return new GuildMemberAddInstance($repository);
    }
    
}
