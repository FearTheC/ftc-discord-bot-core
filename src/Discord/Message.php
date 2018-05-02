<?php
namespace FTCBotCore\Discord;

abstract class Message
{

    /**
     * @var string
     */
    private $eventType;
    
    /**
     * @var array
     */
    protected $data;
    
    /*
     * @var float
     */
    private $creationTime;
    
    public function __construct(array $body)
    {
        $this->data = $body['data'];
        $this->creationTime = $body['timestamp'];
    }
    
    public function getData() : array
    {
        return $this->data;
    }
    
    public function getId() : int
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }
    
    public function getEventType() : string
    {
        return static::EVENT_NAME;
    }
    
    public function getUserId() : int
    {
        if (isset($this->data['user'])) {
            return $this->data['user']['id'];
        }
    }
    
    public function getUsername() : string
    {
        if (isset($this->data['user'])) {
            return $this->data['user']['username'];
        }
    }
    
    public function getAuthorId() : int
    {
        if (isset($this->data['author'])) {
            return $this->data['author']['id'];
        }
    }
    
    public function getGuildId() : int
    {
        if (isset($this->data['guild_id'])) {
            return $this->data['guild_id'];
        }
    }
    
    public function getCreationTime() : float
    {
        return $this->creationTime;
    }
    
}
