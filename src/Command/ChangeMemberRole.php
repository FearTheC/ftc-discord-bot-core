<?php
namespace FTCBotCore\Command;


class ChangeMemberRole
{
    
    const SELECT_QUERY = "SELECT DISTINCT r.name, count(users.id) FROM users
        JOIN users_roles roles on roles.user_id = users.id
        JOIN guilds_roles r ON r.id = roles.role_id AND r.guild_id = :guild_id AND r.name IN (%s)
        GROUP BY (r.name);";
    const SELECT_GUILD_ROLES = "SELECT name FROM guilds_roles where guild_id = :guild_id and name <> '@everyone'";
    
    private $database;
    
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }
    
    public function __invoke()
    {
        return 'LLLL';
    }
    
}
