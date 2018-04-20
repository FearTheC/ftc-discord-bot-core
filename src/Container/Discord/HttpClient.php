<?php
namespace FTCBotCore\Container\Discord;

use Psr\Container\ContainerInterface;
use FTCBotCore\Discord\Client;

class HttpClient
{
    
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['discord'];
        $config['http']['defaults']['headers']['Authorization'] = 'Bot '.$config['token'];

        return new Client($config['http']);
    }
    
}
