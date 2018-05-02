<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Message;

use FTCBotCore\Discord\Message;

class GuildMemberAdd extends Message
{
    
    const EVENT_NAME = 'GUILD_MEMBER_ADD';
    
    public function getUserRoles()
    {
        if (isset($this->data['roles'])) {
            return $this->data['roles'];
        }
    }
    
}
