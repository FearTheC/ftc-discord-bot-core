<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;
use FTCBotCore\Command\Dispatcher;
use FTCBotCore\Message\Message;

class MessageCreate 
{
    
    /**
     * @var ClientInterface
     */
    private $discordClient;
    
    
    private $dispatcher;


    public function __construct(
        ClientInterface $discordClient,
        Dispatcher $dispatcher
    ) {
        $this->discordClient = $discordClient;
        $this->dispatcher = $dispatcher;
    }
    
    
    public function __invoke(Message $message)
    {
        if ($command = $message->getCommand()) {
            if ($cmdHandler = $this->dispatcher->get($command)) { 
                $str = $cmdHandler($message);
            }
        }
        
        return true;
    }

}
