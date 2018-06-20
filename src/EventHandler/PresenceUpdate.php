<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;


use FTCBotCore\Db\DbCacheInterface;
use FTC\Discord\Message\PresenceUpdate as PresenceUpdateMessage;

class PresenceUpdate 
{
    const INSERT_GAME_Q = "INSERT INTO games (name) VALUES (:name) ON CONFLICT DO NOTHING RETURNING id";
    const SELECT_GAMEID_Q = "SELECT id FROM games WHERE name=:name";
    const INSERT_GAME_SESSION_Q = 'INSERT INTO game_presence (game_id, start, "end") VALUES (:game_id, :start, :end)';
    
    private $database;
    
    /**
     * @var DbCacheInterface
     */
    private $cache;
    
    
    public function __construct($database, DbCacheInterface $cache)
    {
        $this->database = $database;
        $this->cache = $cache;
    }
    
    
    public function __invoke(PresenceUpdateMessage $message)
    {
        $userId = $message->getUserId();
        $guildId = $message->getGuildId();
//         $activity = $data['game'];

        if ($message->isGameSessionStart()) {
//         if ($this->hasStartPlayingGame($data)) {
            $gameId =  $this->getGameId($message->getGameName());
            $this->cache->setPlayingSession($gameId, $userId, $message->getSessionStart());
            
            return true;
        }
        
        if ($this->hasStoppedPlayingGame($message->getData())) {
            $session = $this->cache->getPlayingSession($userId);
            list($gameId, $startTime) = explode('@', $session);
            $stopTime = round(microtime(true));
            $this->insertGameSession($gameId, (int) $startTime, (int) $stopTime);
            $this->cache->delPlayingSession($userId);
        }
        
        return true;
    }

    
    private function getPlayingSession(int $userId)
    {
        return $this->cache->getPlayingSession($userId);
    }
    
    
    private function insertGameSession($gameId, int $startTime, int $endTime)
    {
        $startTime = date('c', $startTime);
        $endTime = date('c', $endTime);
        $q = $this->database->prepare(self::INSERT_GAME_SESSION_Q);
        $q->bindParam('game_id', $gameId, \PDO::PARAM_INT);
        $q->bindParam('start', $startTime, \PDO::PARAM_INT);
        $q->bindParam('end', $endTime, \PDO::PARAM_INT);
        $q->execute();
    }
    
    
    private function hasStoppedPlayingGame(array $data) : bool
    {
        $hasActiveGameSessions = $this->cache->getPlayedGame((int) $data['user']['id']);
        if ($hasActiveGameSessions && $data['game'] == null) {
            return true;
        }
        
        return false;
    }
    
    
    private function hasStartPlayingGame(array $data)
    {
        return (isset($data['game']) && $data['game']['type'] == 0);
    }
    
    
    private function getGameId(string $name)
    {
        $id= $this->cache->getGameId($name);
        
        if ($id) {
            return $id;
        }
            
        $q = $this->database->prepare(self::SELECT_GAMEID_Q);
        $q->bindParam('name', $name, \PDO::PARAM_STR);
        $q->execute();
        $id= $q->fetchColumn();
        
        if (!$id) {
            $q = $this->database->prepare(self::INSERT_GAME_Q);
            $q->bindParam('name', $name, \PDO::PARAM_STR);
            $q->execute();
            $id= $q->fetchColumn();
        }
        
        $this->cache->setGame($name, $id);
        
        return $id;
    }

}
