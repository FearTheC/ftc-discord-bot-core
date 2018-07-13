<?php
namespace FTCBotCore\Command;

use FTCBotCore\Message\MessageCreate;

class RemoveMemberRole
{
    
//     const SELECT_QUERY = "SELECT DISTINCT r.name, count(users.id) FROM users
//         JOIN members_roles roles on roles.user_id = users.id
//         JOIN guilds_roles r ON r.id = roles.role_id AND r.guild_id = :guild_id AND r.name IN (%s)
//         GROUP BY (r.name);";
//     const SELECT_GUILD_ROLES = "SELECT name FROM guilds_roles where guild_id = :guild_id and name <> '@everyone'";

    const CMD_SYNTAX = "!removeMemberRole %s %s";
    
    private $database;
    
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }
    
    public function __invoke(MessageCreate $msg)
    {
        
        return $this->help();
        $args = array_slice(explode(' ', $msg->getContent()), 1);
        if ($args) {
            $results = $this->getRoleCount($msg->getGuildId(), $args);
        } else {
            $results = $this->getAvailableRoleArgs($msg->getGuildId());
        }
        
        return $results;
    }
    
    private function help()
    {
        return sprintf(self::CMD_SYNTAX, "MemberName", "Role");
    }
    
    private function getRoleCount(int $guildId, array $args)
    {
        $roles = $args;
        foreach ($args as $key => $arg) {
            $args[$key] = "'".$arg."'";
        }
        
        $query = sprintf(self::SELECT_QUERY, implode(', ', $args));
        $query = $this->database->prepare($query);
        $query->bindParam(':guild_id', $guildId, \PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_NAMED);
        
        $str = '';
        foreach ($results as $row) {
            if (in_array($row['name'], $roles)) {
                $str .= $row['name'].': '.$row['count'].PHP_EOL;
                unset($roles[array_search($row['name'], $roles)]);
            }
        }
        
        if (!empty($roles)) {
            $str .= 'Following roles doesn\'t exist, please check their spelling: '.implode(', ', $roles).PHP_EOL;
        }
        
        return $str;
    }
    
    private function getAvailableRoleArgs(int $guildId)
    {
        
        $query = $this->database->prepare(self::SELECT_GUILD_ROLES);
        $query->bindParam(':guild_id', $guildId, \PDO::PARAM_STR);
        $query->execute();
        
        $results = $query->fetchAll(\PDO::FETCH_COLUMN);
        $str = 'Please select at least one of the following roles : '.implode(', ', $results);
        
        return $str;
    }
}
