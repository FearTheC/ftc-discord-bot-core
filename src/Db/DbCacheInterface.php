<?php
namespace FTCBotCore\Db;

interface DbCacheInterface
{
    public function getPlayedGame(int $userId) : ?int;
    
    public function setPlayingSession(int $gameId, int $userId, int $startTime) : void;
    
    public function delPlayingSession(int $userId) : void;
    
    public function setGame(string $name, int $id) : void;
    
    public function getGameId(string $name) : ?int;
    
}
