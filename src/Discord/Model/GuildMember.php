<?php
namespace FTCBotCore\Discord\Model;

class GuildMember
{
    
    private $username;
    
    private $id;
    
    private function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public static function register(int $id, string $username) : GuildMember
    {  
        $member = new GuildMember($id, $username);
        return $member;
    }
    
}
