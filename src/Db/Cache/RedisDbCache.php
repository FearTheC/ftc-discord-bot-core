<?php
namespace FTCBotCore\Db\Cache;

use FTCBotCore\Db\DbCacheInterface;
use RedisClient\RedisClient;

class RedisDbCache implements DbCacheInterface
{
    const GAMES_HASH_KEY = 'games';
    
    const USERS_PLAYING_KEY = 'users_playing';
    
    /**
     * @var RedisClient 
     */
    private $client;
    
    public function __construct(RedisClient $client)
    {
        $this->client = $client;
    }
    
    public function getPlayingSession(int $userId) : ?string
    {
        return $this->client->hget(self::USERS_PLAYING_KEY, $userId);
    }
    
    public function getPlayedGame(int $userId) : ?int
    {
        if ($value = $this->getPlayingSession($userId)) {
            return explode('@', $value)[0];
        }
        
        return null;
    }
    
    public function delPlayingSession(int $userId) : void
    {
        $this->client->hdel(self::USERS_PLAYING_KEY, $userId);
    }
    
    public function setPlayingSession(int $gameId, int $userId, int $startTime) : void
    {
        $startTime = (int) round($startTime/1000);
        $this->client->hsetnx(self::USERS_PLAYING_KEY, $userId, $gameId.'@'.$startTime);
    }
    
    public function getGameId(string $name) : ?int
    {
        return $this->client->hget(self::GAMES_HASH_KEY, $name);
    }
    
    public function setGame(string $name, int $id) : void
    {
        $this->client->hsetnx(self::GAMES_HASH_KEY, $name, $id);
    }
    
}
