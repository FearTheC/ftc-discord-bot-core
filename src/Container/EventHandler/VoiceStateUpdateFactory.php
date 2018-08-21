<?php

declare(strict_types=1);

namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTC\Discord\Model\Service\VocalPresenceService;
use FTCBotCore\EventHandler\VoiceStateUpdate;

class VoiceStateUpdateFactory
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $vocalPresenceService = $container->get(VocalPresenceService::class);

        return new VoiceStateUpdate($vocalPresenceService);
    }
    
}
