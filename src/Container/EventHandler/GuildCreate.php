<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildCreate as GuildCreateInstance;
use FTC\Discord\Db\Core;
use FTCBotCore\Command\Dispatcher;
use FTC\Discord\Model\GuildRepository;
use FTC\Discord\Model\UserRepository;

class GuildCreate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $guildRepository = $container->get(GuildRepository::class);
        $userRepository = $container->get(UserRepository::class);

        return new GuildCreateInstance($guildRepository, $userRepository);
    }
    
}
