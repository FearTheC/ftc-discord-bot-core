<?php
namespace FTCBotCore\Discord\Repository;


use FTCBotCore\Discord\Model\GuildRoleRepository as RepositoryInterface;
use FTCBotCore\Discord\Model\GuildRole;

class GuildRoleRepository extends PostgresqlRepository implements RepositoryInterface
{
    /**
     * @var GuildRole[]
     */
    private $guilds;
    
    public function save(GuildRole $member)
    {
        
    }
    
    public function getAll() : array
    {
        
    }
    
    public function findById(int $id) : GuildRole
    {
        
    }
    
}
