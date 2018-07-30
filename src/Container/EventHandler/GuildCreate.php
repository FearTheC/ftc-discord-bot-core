<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\GuildCreate as GuildCreateInstance;
use FTC\Discord\Model\Service\GuildCreation;
use FTC\Discord\Model\Aggregate\UserRepository;

class GuildCreate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $guildCreationService = $container->get(GuildCreation::class);
        $userRepository = $container->get(UserRepository::class);

        return new GuildCreateInstance($guildCreationService, $userRepository);
    }
    
}
