<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTCBotCore\EventHandler\ChannelCreate;
use FTC\Discord\Model\Channel\DMChannel\DMRepository;

class ChannelCreateFactory
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $channelRepository = $container->get(GuildChannelRepository::class);
        $dmRepository = $container->get(DMRepository::class);

        return new ChannelCreate($channelRepository, $dmRepository);
    }
    
}
