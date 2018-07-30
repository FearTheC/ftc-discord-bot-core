<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTCBotCore\EventHandler\ChannelCreate;

class ChannelUpdateFactory
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $channelRepository = $container->get(GuildChannelRepository::class);

        return new ChannelCreate($channelRepository);
    }
    
}
