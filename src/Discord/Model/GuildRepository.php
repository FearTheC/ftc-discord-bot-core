<?php
namespace FTCBotCore\Discord\Model;

interface GuildRepository
{
    
    public function save(Guild $member);
    
    public function getAll() : array;
    
    public function findById(int $id) : Guild;
    
}