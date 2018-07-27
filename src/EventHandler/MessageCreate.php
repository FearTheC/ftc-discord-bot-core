<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;
use FTCBotCore\Command\Dispatcher;
use FTCBotCore\Message\Message;
use FTC\Discord\Model\Aggregate\GuildMessage;
use FTC\Discord\Model\ValueObject\Snowflake\MessageId;
use FTC\Discord\Model\ValueObject\MessageType;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Text\ChannelMessage;
use FTC\Discord\Model\Aggregate\GuildMessageRepository;

class MessageCreate 
{
    
    /**
     * @var ClientInterface
     */
    private $discordClient;
    
    /**
     * @var Dispatcher
     */    
    private $dispatcher;

    /**
     * @var GuildMessageRepository
     */
    private $messageRepository;

    public function __construct(
        ClientInterface $discordClient,
        Dispatcher $dispatcher,
        GuildMessageRepository $messageRepository
    ) {
        $this->discordClient = $discordClient;
        $this->dispatcher = $dispatcher;
        $this->messageRepository = $messageRepository;
    }
    
    public function __invoke(Message $message)
    {
        if ($command = $message->getCommand()) {
            if ($cmdHandler = $this->dispatcher->get($command)) { 
                $str = $cmdHandler($message);
            }
        }
        
        $data = $message->getData();
        
        if (!isset($data['author']['bot']) OR !$data['author']['bot']) {
            if (isset($data['edited_timestamp'])) {
                $updateTime = new \DateTime($data['edited_timestamp']);
            }
    
            $message = new GuildMessage(
                MessageId::create((int) $data['id']),
                ChannelId::create((int) $data['channel_id']),
                UserId::create((int) $data['author']['id']),
                MessageType::create((int) $data['type']),
                ChannelMessage::create($data['content']),
                new \DateTime($data['timestamp']),
                $updateTime ?? null,
                $data['pinned']
            );
            
            $this->messageRepository->save($message);
        }
        
        return true;
    }

}
