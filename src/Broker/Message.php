<?php
namespace FTCBotCore\Broker;

class Message
{

    private $eventType;
    
    private $data;
    
    public function __construct(array $body)
    {
        $this->data = $body['data'];
        $this->eventType = $body['event'];
    }
    
    public function getData() : array
    {
        return $this->data;
    }
    
    public function getEventType() : string
    {
        return $this->eventType;
    }
    
}
