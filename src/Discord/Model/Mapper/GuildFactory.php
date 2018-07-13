<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Model\Mapper;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\GuildName;
use FTC\Discord\Model\Collection\GuildChannelCollection;
use FTC\Discord\Model\Aggregate\Guild;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\Collection\GuildRoleIdCollection;
use FTC\Discord\Model\Collection\GuildMemberIdCollection;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Collection\GuildChannelIdCollection;

class GuildFactory
{

    public function fromMessage(Message $message)
    {
        
        $data = $message->getData();
        $name = GuildName::create($data['name']);
        $guildId = GuildId::create((int) $data['id']);
        $ownerId = UserId::create((int) $data['owner_id']);

        $rolesArray = array_map(function($role) {return RoleId::create((int) $role['id']); }, $data['roles']);
        $guildRoles = new GuildRoleIdCollection(...$rolesArray);

        $membersArray = array_map(function($user) {return UserId::create((int) $user['user']['id']); }, $data['members']);
        $members = new GuildMemberIdCollection(...$membersArray);
        
        $channelArray = array_map(function($channel) {return ChannelId::create((int) $channel['id']); }, $data['channels']);
        $channels = new GuildChannelIdCollection(...$channelArray);
        
        
        
        return  Guild::create($guildId, $name, $ownerId, $guildRoles, $members, $channels);
    }
    
}
