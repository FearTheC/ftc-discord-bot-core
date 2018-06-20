<?php
namespace FTCBotCore\Discord\Repository;


use FTC\Discord\Model\GuildRepository as RepositoryInterface;
use FTC\Discord\Model\Guild;

class GuildRepository extends PostgresqlRepository implements RepositoryInterface
{
    /**
     * @var Guild[]
     */
    private $guilds;
    
    public function save(Guild $member)
    {
        
    }
    
    public function getAll() : array
    {
        
    }
    
    public function findById(int $id) : Guild
    {
        
    }
    
}
