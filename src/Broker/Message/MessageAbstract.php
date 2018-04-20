<?php declare(strict_types=1);

namespace FTCBotCore\Broker\Message;

class MessageAbstract
{
    
    public function getMessageType()
    {
        return static::EVENT_NAME;
    }
    
    public function getData()
    {
        return $this->data;
    }
    
}
