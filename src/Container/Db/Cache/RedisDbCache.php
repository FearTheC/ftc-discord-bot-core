<?php
namespace FTCBotCore\Container\Db\Cache;

use FTCBotCore\Db\Cache\RedisDbCache as RedisDbCacheInstance;
use Psr\Container\ContainerInterface;
use RedisClient\RedisClient;

class RedisDbCache
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['core-db'];
        $client = new RedisClient($config['cache']);
        
        return new RedisDbCacheInstance($client);
    }
}
