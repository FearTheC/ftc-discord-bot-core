<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;
use FTCBotCore\Command\Dispatcher;

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
    
    public function __invoke($message)
    {
        if ($this->hasCommand($message['content'])) {
            if (explode(' ', $message['content'])[0] == '!count') {
                $cmd = $this->dispatcher->get('count');
                $results = $cmd($message['guild_id']);
                
                $str = '';
                foreach ($results as $row) {
                    $str .= $row['name'].': '.$row['count'].PHP_EOL;
                }
                $this->discordClient->answer($str, $message['channel_id']);
            } else {
                $this->discordClient->answer('Hello ! Je ne sais pas quoi te répondre pour l\'instant !', $message['channel_id']);
            }
        }
        
        return true;
    }
    
    private function hasCommand($message)
    {
        return (substr($message, 0, 1) == '!');
    }
    
}
