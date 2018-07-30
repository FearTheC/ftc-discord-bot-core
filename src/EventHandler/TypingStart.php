<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

class TypingStart extends Message
{
    
    public function __invoke()
    {
        return true;
    }
    
}
