<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;
use FTCBotCore\Command\Dispatcher;
use FTCBotCore\Discord\Message;
use FTCBotCore\Db\DbCacheInterface;

class GuildMemberAdd 
{
    
    const ADD_USER_Q = "INSERT INTO users VALUES (:user_id, :username) ON CONFLICT ON CONSTRAINT users_pkey DO NOTHING";
    const ADD_GUILD_USER_Q = "INSERT INTO guilds_users VALUES (:guild_id, :user_id)";
    
    /**
     * @var DbCacheInterface
     */
    private $cache;
    
    /**
     * @var \PDO
     */
    private $database;
    

    public function __construct(
        $database,
        DbCacheInterface $cache
    ) {
        $this->database = $database;
        $this->cache = $cache;
    }
    
    public function __invoke(Message $message)
    {
        $userId = $message->getUserId();
        $username = $message->getUsername();
        $guildId = $message->getGuildId();
        
        $q = $this->database->prepare(self::ADD_USER_Q);
        $q->bindParam('user_id', $userId, \PDO::PARAM_INT);
        $q->bindParam('username', $username, \PDO::PARAM_STR);
        $q->execute();
        
        $q = $this->database->prepare(self::ADD_GUILD_USER_Q);
        $q->bindParam('guild_id', $guildId, \PDO::PARAM_INT);
        $q->bindParam('user_id', $userId, \PDO::PARAM_INT);
        $q->execute();
        
        return true;
    }
    
    private function hasCommand($message)
    {
        return (substr($message, 0, 1) == '!');
    }

}
