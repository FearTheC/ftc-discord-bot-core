<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildMemberAdd as GuildMemberAddInstance;
use FTCBotCore\Db\Core;
use FTCBotCore\Db\DbCacheInterface;
use FTCBotCore\Command\Dispatcher;
use FTCBotCore\Discord\Repository\GuildMemberRepository;
use FTCBotCore\Container\Discord\Repository\GuildMemberReposito;

class GuildMemberAdd
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $repository = $container->get(GuildMemberRepository::class);

        return new GuildMemberAddInstance($repository);
    }
    
}
