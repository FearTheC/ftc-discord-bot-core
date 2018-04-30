<?php
namespace FTCBotCore\Container\Broker;

use Psr\Container\ContainerInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use FTCBotCore\Broker\Client\AMQPClient;

class AMQPClientFactory
{
    
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['broker'];
        
        $connection = new AMQPStreamConnection(
            $config['host'], 
            $config['port'],
            $config['username'],
            $config['password']
        );
        $messageFactory = $container->get('EventMessageFactory');
        
        return new AMQPClient($connection, $messageFactory);
    }
    
}
