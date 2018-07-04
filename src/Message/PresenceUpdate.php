<?php declare(strict_types=1);

namespace FTCBotCore\Message;

use FTCBotCore\Message\Message;

class PresenceUpdate extends Message
{
    
    const EVENT_NAME = 'PRESENCE_UPDATE';
    
    public function isGameSessionStart()
    {
        return (isset($this->getData()['game']) &&
            $this->getData()['game']['type'] == 0 &&
            isset($this->getData()['game']['timestamps']['start']));
    }
    
    public function getSessionStart()
    {
        $start = null;

        if ($this->isGameSessionStart()) {
            $start = $this->getData()['game']['timestamps']['start'];
        }
        
        return $start;
    }
    
    public function getGameName()
    {
        $name = null;
        if ($this->isGameSessionStart()) {
            $name = $this->getData()['game']['name'];
        }
        
        return $name;
    }
}
