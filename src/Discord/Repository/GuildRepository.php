<?php
namespace FTCBotCore\Discord\Repository;


use FTCBotCore\Discord\Model\GuildRepository as RepositoryInterface;
use FTCBotCore\Discord\Model\Guild;

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
