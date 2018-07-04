<?php declare(strict_types=1);

namespace FTCBotCore\Message;

use FTCBotCore\Message\Message;

class MessageCreate extends Message
{
    
    const EVENT_NAME = 'MESSAGE_CREATE';
    
    public function getContent()
    {
        return $this->getData()['content'];
    }
    
    public function getChannelId()
    {
        return $this->getData()['channel_id'];
    }
    
    public function isCommand()
    {
        return (substr($this->getContent(), 0, 1) == '!');
    }
    
    public function getCommand()
    {
        if ($this->isCommand()) {
            $firstWord = explode(' ', $this->getContent())[0];
            return substr($firstWord, 1);
        }
        
        return false;
    }
}
