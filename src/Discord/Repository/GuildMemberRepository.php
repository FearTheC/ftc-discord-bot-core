<?php
namespace FTCBotCore\Discord\Repository;


use FTCBotCore\Discord\Model\GuildMemberRepository as RepositoryInterface;
use FTCBotCore\Discord\Model\GuildMember;

class GuildMemberRepository extends PostgresqlRepository implements RepositoryInterface
{
    
    const GET_ALL_QUERY = 'SELECT id, username FROM users ORDER BY id DESC';
    
    /**
     * @var GuildMember[]
     */
    private $members;
    
    public function add(GuildMember $member)
    {
        
    }
    
    public function remove(GuildMember $member)
    {
        
    }
    
    public function getAll() : array
    {
        $stmt = $this->persistence->prepare(self::GET_ALL_QUERY);
        var_dump($stmt);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findById(int $id) : GuildMember
    {
        
    }
    
}
