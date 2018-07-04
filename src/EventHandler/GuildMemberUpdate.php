<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;


use FTCBotCore\Db\DbCacheInterface;
use FTCBotCore\Message\GuildMemberUpdate as GuildMemberUpdateMessage;

class GuildMemberUpdate 
{
    
    const INSERT_USER_ROLE_Q = "insert into users_roles VALUES (:user_id, :role_id) ON CONFLICT ON CONSTRAINT users_roles_pkey DO NOTHING";
    const DELETE_ROLES_Q = "DELETE FROM users_roles WHERE user_id = :user_id";
    const WHERE_ROLES_NOT_IN_CLAUSE = " AND role_id NOT IN (%s)";
    
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
    

    public function __invoke(GuildMemberUpdateMessage $message)
    {
        $userId = $message->getUserId();
        $guildId = $message->getGuildId();
        $currentRoles = $message->getUserRoles();

        $this->updateUserRoles($userId, $currentRoles);
        
        return true;
    }

    private function updateUserRoles(int $userId, array $roles)
    {
        $unpreparedQuery = self::DELETE_ROLES_Q;
        if (count($roles) > 0) {
            $unpreparedQuery .= sprintf(self::WHERE_ROLES_NOT_IN_CLAUSE, implode(',', $roles));
        }
        echo $unpreparedQuery;
        $q = $this->database->prepare($unpreparedQuery);
        $q->bindParam('user_id', $userId, \PDO::PARAM_INT);
        $q->execute();
        
        foreach ($roles as $roleId) {
            $q = $this->database->prepare(self::INSERT_USER_ROLE_Q);
            $q->bindParam('user_id', $userId, \PDO::PARAM_INT);
            $q->bindParam('role_id', $roleId, \PDO::PARAM_INT);
            $q->execute();
        }
    }

}
