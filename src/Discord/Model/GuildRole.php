<?php
namespace FTCBotCore\Discord\Model;

class GuildRole
{
    private $id;
    
    private $name;
    
    private $guildId;
    
    private function __construct(
        int $id,
        string $name,
        int $guildId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->guildId = $guildId;
    }
    
    public static function fromDbRow(array $data)
    {
        return new GuildRole($data['id'], $data['name'], $data['guild_id']);
    }
    
}
