<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;

class ChannelDelete 
{
    
    /**
     * @var GuildChannelRepository
     */
    private $repository;
    

    public function __construct(GuildChannelRepository $repository) {
        $this->repository= $repository;
    }
    
    public function __invoke(Message $message)
    {
        $data = $message->getData();
        
        $this->repository->delete(ChannelId::create((int) $data['id']));
        
        return true;
    }

}
