<?php declare(strict_types=1);

namespace FTCBotCore\Message;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\GuildMember;

class TypingStart extends Message
{
    
    const EVENT_NAME = 'TYPING_START';
    
    
    public function __construct($body)
    {
        parent::__construct($body);
    }
}
