<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Message;

use FTCBotCore\Discord\Message;

class GuildCreate extends Message
{
    
    const EVENT_NAME = 'GUILD_CREATE';
    
    public function getGuildId() : int
    {
        return (int) $this->getData()['id'];
    }
    
    public function getGuildName()
    {
        return $this->getData()['name'];
    }
    
    public function getRoles()
    {
        return $this->getData()['roles'];
    }
    
    public function getUsers()
    {
        return $this->getData()['members'];
    }
    
    public function getChannels()
    {
        return $this->getData()['channels'];
    }
    
}
