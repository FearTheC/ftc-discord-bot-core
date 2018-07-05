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
//             ,
//             '/',
//             false,
//             'AMQPLAIN',
//             null,
//             'en_US',
//             10,
//             30,
//             null,
//             true,
//             15
        );
        $messageFactory = $container->get('EventMessageFactory');
        
        return new AMQPClient($connection, $messageFactory);
    }
    
}
