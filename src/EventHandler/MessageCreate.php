<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;
use FTCBotCore\Command\Dispatcher;
use FTCBotCore\Discord\Message;

class MessageCreate 
{
    
    /**
     * @var ClientInterface
     */
    private $discordClient;
    
    private $dispatcher;
    
    public function __construct(ClientInterface $discordClient, Dispatcher $dispatcher)
    {
        $this->discordClient = $discordClient;
        $this->dispatcher = $dispatcher;
    }
    
    public function __invoke(Message $message)
    {
        if ($command = $message->getCommand()) {
            if ($command == 'count') {
                $cmd = $this->dispatcher->get('count');
                $results = $cmd($message->getGuildId());
                
                $str = '';
                foreach ($results as $row) {
                    $str .= $row['name'].': '.$row['count'].PHP_EOL;
                }
                $this->discordClient->answer($str, $message->getChannelId());
            } else {
                $this->discordClient->answer('Hello ! Je ne sais pas quoi te répondre pour l\'instant !', $message->getChannelId());
            }
        }
        
        return true;
    }
    
    private function hasCommand($message)
    {
        return (substr($message, 0, 1) == '!');
    }
    
}
