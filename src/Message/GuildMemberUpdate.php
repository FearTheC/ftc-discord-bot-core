<?php declare(strict_types=1);

namespace FTCBotCore\Message;

use FTCBotCore\Message\Message;
use FTCBotCore\Message\Traits\GuildMemberPayload;

class GuildMemberUpdate extends Message
{
    
    use GuildMemberPayload;
    
    const EVENT_NAME = 'GUILD_MEMBER_UPDATE';
    
    public function getUserRoles()
    {
        if (isset($this->data['roles'])) {
            return $this->data['roles'];
        }
    }
    
    
}
