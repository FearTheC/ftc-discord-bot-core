<?php
namespace FTCBotCore\Command;

class UpdateRole
{
    
    const SELECT_QUERY = "SELECT DISTINCT r.name, count(users.id) FROM users
        JOIN members_roles roles on roles.user_id = users.id
        JOIN guilds_roles r ON r.id = roles.role_id AND r.guild_id = :guild_id
        GROUP BY (r.name);";
    
    private $database;
    
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }
    
    public function __invoke($guildId)
    {
        $query = $this->database->prepare(self::SELECT_QUERY);
        $query->bindParam(':guild_id', $guildId, \PDO::PARAM_STR);
        $query->execute();
        
        $results = $query->fetchAll(\PDO::FETCH_NAMED);
        
        return $results;
    }
    
}
