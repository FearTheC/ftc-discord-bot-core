<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTCBotCore\Discord\Model\Mapper\AbstractChannelFactory;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;

class ChannelUpdate 
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
        $channelFactory = new AbstractChannelFactory();
        $channel = $channelFactory->create($data);
        
	return true; 
        $this->repository->save($channel, GuildId::create((int) $data['guild_id']));
        
        return true;
    }

}
