<?php
namespace FTCBotCore\Discord\Model;

interface GuildRoleRepository
{
    public function save(GuildRole $member);
    
    public function getAll() : array;
    
    public function findById(int $id) : GuildRole;
    
    public function findByName(string $name, int $guildId) : ?GuildRole;
    
}