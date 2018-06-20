<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTC\Discord\Message;
use FTC\Discord\Message\GuildCreate as GuildCreateMessage;
use FTCBotCore\Command\Dispatcher as CommandDispatcher;

class GuildCreate 
{
    
    const INSERT_GUILD_Q = "INSERT INTO guilds (id, name)
            SELECT :id, :name  WHERE NOT EXISTS (SELECT 1 FROM guilds WHERE id = :id)";
    const INSERT_ROLE_Q = "INSERT INTO guilds_roles (id, guild_id, name)
            SELECT :id, :guild_id, :name  WHERE NOT EXISTS (SELECT 1 FROM guilds_roles WHERE id = :id)";
    const INSERT_USER_Q = "INSERT INTO users (id, username)
            SELECT :id, :username  WHERE NOT EXISTS (SELECT 1 FROM users WHERE id = :id)";
    const ADD_GUILD_USER_Q = "INSERT INTO guilds_users VALUES (:guild_id, :user_id, :joined_at) ON CONFLICT ON CONSTRAINT guilds_users_pkey DO NOTHING";
    const INSERT_USER_ROLES_Q = "INSERT INTO users_roles (user_id, role_id)
            SELECT :user_id, :role_id  WHERE NOT EXISTS (SELECT 1 FROM users_roles WHERE user_id = :user_id AND role_id = :role_id)";
    const INSERT_CHANNEL_Q = "INSERT INTO channels (id, guild_id, type_id, name)
            SELECT :id, :guild_id, :type_id, :name  WHERE NOT EXISTS (SELECT 1 FROM channels WHERE id = :id)";
    const INSERT_CHANNEL_PARENT_Q = "INSERT INTO channels_parents (channel_id, parent_id)
            SELECT :channel_id, :parent_id WHERE NOT EXISTS (SELECT 1 FROM channels_parents WHERE channel_id = :channel_id AND parent_id = :parent_id)";
    
    private $database;
    
    private $commandDispatcher;
    
    public function __construct(
        \PDO $database,
        CommandDispatcher $dispatcher)
    {
        $this->database = $database;
        $this->commandDispatcher = $dispatcher;
    }
    
    public function __invoke(
        GuildCreateMessage $message)
    {
        $guildId = $message->getGuildId();
        $this->setGuild($guildId, $message->getGuildName());
        
        foreach ($message->getRoles() as $role) {
            $this->setRole($role['id'], $guildId, $role['name']);
        }
        
        foreach ($message->getUsers() as $user) {
            $this->setUser($user['user']['id'], $user['user']['username']);
            $this->setUserRoles($user['user']['id'], $user['roles']);
            $this->setUserGuild($guildId, $user['user']['id'], $user['joined_at']);
        }

        foreach ($message->getChannels() as $channel) {
            $this->setChannel($channel['id'], $channel['type'], $channel['name'], $guildId);
        }
        
        foreach ($message->getChannels() as $channel) {
            if(isset($channel['parent_id'])) {
                $this->setChannelParent($channel['id'], $channel['parent_id']);
            }
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
    
    private function setUserGuild($guildId, $userId, $joinedAt)
    {
        $q = $this->database->prepare(self::ADD_GUILD_USER_Q);
        $q->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $q->bindParam(':guild_id', $guildId, \PDO::PARAM_INT);
        $q->bindParam('joined_at', $joinedAt);
        $q->execute();

        $q = $this->database->prepare("update guilds_users set joined_date = :joined_at WHERE user_id = :user_id and guild_id = :guild_id");
        $q->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $q->bindParam(':guild_id', $guildId, \PDO::PARAM_INT);
        $q->bindParam('joined_at', $joinedAt, \PDO::PARAM_INT);
        $q->execute();
    }
    
    private function setChannel($id, $type, $name, $guildId = null)
    {
        $q = $this->database->prepare(self::INSERT_CHANNEL_Q);
        $q->bindParam(':id', $id, \PDO::PARAM_INT);
        $q->bindParam(':guild_id', $guildId, \PDO::PARAM_INT);
        $q->bindParam(':type_id', $type, \PDO::PARAM_INT);
        $q->bindParam(':name', $name, \PDO::PARAM_STR);
        $q->execute();
    }
    
    private function setChannelParent($id, $parentId)
    {
        $q = $this->database->prepare(self::INSERT_CHANNEL_PARENT_Q);
        $q->bindParam(':channel_id', $id, \PDO::PARAM_INT);
        $q->bindParam(':parent_id', $parentId, \PDO::PARAM_INT);
        $q->execute();
    }
    
}
