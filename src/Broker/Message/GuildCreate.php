<?php declare(strict_types=1);

namespace FTCBotCore\Broker\Message;

class GuildCreate extends MessageAbstract
{
    
    const EVENT_NAME = 'GUILD_CREATE';
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
}
