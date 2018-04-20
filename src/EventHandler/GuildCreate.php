<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;

class GuildCreate 
{
    
    const INSERT_GUILD_Q = "INSERT INTO guilds (id, name)
            SELECT :id, :name  WHERE NOT EXISTS (SELECT 1 FROM guilds WHERE id = :id)";
    const INSERT_ROLE_Q = "INSERT INTO guilds_roles (id, guild_id, name)
            SELECT :id, :guild_id, :name  WHERE NOT EXISTS (SELECT 1 FROM guilds_roles WHERE id = :id)";
    const INSERT_USER_Q = "INSERT INTO users (id, username)
            SELECT :id, :username  WHERE NOT EXISTS (SELECT 1 FROM users WHERE id = :id)";
    const INSERT_USER_ROLES_Q = "INSERT INTO users_roles (user_id, role_id)
            SELECT :user_id, :role_id  WHERE NOT EXISTS (SELECT 1 FROM users_roles WHERE user_id = :user_id AND role_id = :role_id)";
    const INSERT_CHANNEL_Q = "INSERT INTO channels (id, guild_id, parent_id, type_id, name)
            SELECT :id, :guild_id, :parent_id, :type_id, :name  WHERE NOT EXISTS (SELECT 1 FROM guilds WHERE id = :id)";
    
    private $database;
    
    public function __construct($database)
    {
        $this->database = $database;
    }
    
    public function execute($data)
    {
//         $this->setGuild($data['id'], $data['name']);
        
//         foreach ($data['roles'] as $role) {
//             $this->setRole($role['id'], $data['id'], $role['name']);
//         }
        
//         foreach ($data['members'] as $user) {
//             $this->setUser($user['user']['id'], $user['user']['username']);
//             $this->setUserRoles($user['user']['id'], $user['roles']);
//         }
        foreach ($data['channels'] as $channel) {
            $this->setChannel($channel['id'], $channel['type'], $channel['name'], $channel['guild_id'], $channel['parent_id']);
        }
        
        return true;
    }
    
    private function hasCommand($message)
    {
        return (substr($message, 0, 1) == '!');
    }
    
    private function setGuild($id, $name)
    {
        $q = $this->database->prepare(self::INSERT_GUILD_Q);
        $q->bindParam(':id', $id, \PDO::PARAM_INT);
        $q->bindParam(':name', $name, \PDO::PARAM_STR);
        $q->execute();
    }
    
    private function setRole($id, $guildId, $name)
    {
        $q = $this->database->prepare(self::INSERT_ROLE_Q);
        $q->bindParam(':id', $id, \PDO::PARAM_INT);
        $q->bindParam(':guild_id', $guildId, \PDO::PARAM_INT);
        $q->bindParam(':name', $name, \PDO::PARAM_STR);
        $q->execute();
    }
    
    private function setUser($id, $name)
    {
        $q = $this->database->prepare(self::INSERT_USER_Q);
        $q->bindParam(':id', $id, \PDO::PARAM_INT);
        $q->bindParam(':username', $name, \PDO::PARAM_STR);
        $q->execute();
    }
    
    private function setUserRoles($userId, $roles)
    {
        $q = $this->database->prepare(self::INSERT_USER_ROLES_Q);
        $q->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        foreach ($roles as $role) {
            $q->bindParam(':role_id', $role, \PDO::PARAM_INT);
            $q->execute();
        }
    }
    
    private function setChannel($id, $type, $name, $guildId = null, $parentId = null)
    {
        $q = $this->database->prepare(self::INSERT_CHANNEL_Q);
        $q->bindParam(':id', $id, \PDO::PARAM_INT);
        $q->bindParam(':guild_id', $guildId, \PDO::PARAM_INT);
        $q->bindParam(':parent_id', $parentId, \PDO::PARAM_INT);
        $q->bindParam(':type_id', $type, \PDO::PARAM_INT);
        $q->bindParam(':name', $name, \PDO::PARAM_STR);
        $q->execute();
    }
    
}
