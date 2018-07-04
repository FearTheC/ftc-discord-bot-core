<?php declare(strict_types=1);

namespace FTCBotCore\Message;

use FTCBotCore\Message\Message;

class GuildDelete extends Message
{
    
    const EVENT_NAME = 'GUILD_DELETE';
    
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
