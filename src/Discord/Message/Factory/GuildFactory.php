<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Message\Factory;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\Guild;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\GuildName;
use FTC\Discord\Model\Collection\GuildChannelCollection;

class GuildFactory
{

    public function fromMessage(Message $message)
    {
        $data = $message->getData();
        $name = GuildName::create($data['name']);
        
        $roleFactory = new GuildRoleFactory();
        $rolesArray = array_map([$roleFactory, 'create'], $data['roles']);
        $guildRoles = new GuildRoleCollection(...$rolesArray);
        
        $memberFactory = new GuildMemberFactory();
        $membersArray = array_map([$memberFactory,  'create'], $data['members']);
        $members = new GuildMemberCollection(...$membersArray);
        
        $channelFactory = new AbstractChannelFactory();
        $channelArray = array_map([$channelFactory, 'create'], $data['channels']);
        $channels = new GuildChannelCollection(...$channelArray);
        
        
        
        $guildId = GuildId::create((int) $data['id']);
        $ownerId = UserId::create((int) $data['owner_id']);
        return  Guild::create($guildId, $name, $ownerId, $guildRoles, $members, $channels);
    }
    
}
