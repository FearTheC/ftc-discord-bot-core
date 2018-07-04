<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Message\Factory;

use FTC\Discord\Model\Channel;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Name\ChannelName;
use FTC\Discord\Model\ValueObject\PermissionOverwrite;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;
use FTC\Discord\Model\ValueObject\Text\ChannelTopic;
use FTC\Discord\Model\Channel\GuildChannel\TextChannel;
use FTC\Discord\Model\Channel\GuildChannel\Voice;
use FTC\Discord\Model\Collection\PermissionOverwriteCollection;
use FTC\Discord\Model\Channel\GuildChannel\Category;

class AbstractChannelFactory
{
    
    private $typeMethods = [
        Channel::GUILD_TEXT => 'createGuildTextChannel',
        Channel::GUILD_VOICE => 'createGuildVoiceChannel',
        Channel::GUILD_CATEGORY => 'createGuildCategoryChannel',
        Channel::DM => 'createDMChannel',
        Channel::GROUP_DM => 'createGroupDMChannel',
    ];
    
    public function create($data) : Channel
    {
        $b = $this->{$this->typeMethods[$data['type']]}($data);
        
        return $b;
    }
    
    private function createGuildTextChannel($data)
    {
        return TextChannel::create(
            $this->extractId($data),
            $this->extractName($data),
            $this->extractPosition($data),
            $this->extractPermissionOverwrites($data),
            $this->extractCategoryId($data),
            $this->extractTopic($data)
        );
    }
    
    private function createGuildVoiceChannel($data)
    {
        return Voice::create(
            $this->extractId($data),
            $this->extractName($data),
            $this->extractPosition($data),
            $this->extractPermissionOverwrites($data),
            $this->extractCategoryId($data),
            $this->extractBitrate($data),
            $this->extractUserLimit($data)
        );
    }
    
    private function createGuildCategoryChannel($data)
    {
        return Category::create(
            $this->extractId($data),
            $this->extractName($data),
            $this->extractPosition($data),
            $this->extractPermissionOverwrites($data),
            $this->extractCategoryId($data)
        );
    }
    
    private function extractId($data) : ChannelId
    {
        return ChannelId::create((int) $data['id']);
    }
    
    private function extractName($data) : ChannelName
    {
        return ChannelName::create($data['name']);
    }
    
    private function extractPosition($data) : int
    {
        return (int) $data['position'];
    }
    
    private function extractPermissionOverwrites($data) : PermissionOverwriteCollection
    {
        $permissionOverwrites = array_map(
            function($value) {
                $subjectId = Snowflake::create((int) $value['id']);
                return new PermissionOverwrite($subjectId, $value['allow'], $value['deny']);
            },
            $data['permission_overwrites']
        );
        return new PermissionOverwriteCollection(...$permissionOverwrites);
    }
    
    private function extractCategoryId($data) : ?CategoryId
    {
        if (isset($data['parent_id'])) {
            return CategoryId::create((int) $data['parent_id']);
        }
        return null;
    }
    
    private function extractTopic($data)
    {
        if (isset($data['topic'])) {
            return ChannelTopic::create($data['topic']);
        }
        return null; 
    }
    
    private function extractBitrate($data) : int
    {
        return $data['bitrate'];
    }
    
    private function extractUserLimit($data) : int
    {
        return $data['user_limit'];
    }
}
