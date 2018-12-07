<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

class ChannelPinsUpdate extends Message
{
    
    public function __invoke()
    {
        return true;
    }
    
}
