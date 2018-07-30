<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Model\Mapper;

use FTC\Discord\Model\Aggregate\GuildChannel;
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
use FTC\Discord\Model\Collection\UserIdCollection;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\MessageId;
use FTC\Discord\Model\Channel\DMChannel\DM;

class AbstractChannelFactory
{
    
    private $typeMethods = [
        GuildChannel::GUILD_TEXT => 'createGuildTextChannel',
        GuildChannel::GUILD_VOICE => 'createGuildVoiceChannel',
        GuildChannel::GUILD_CATEGORY => 'createGuildCategoryChannel',
        GuildChannel::DM => 'createDMChannel',
        GuildChannel::GROUP_DM => 'createGroupDMChannel',
    ];
    
    public function create($data) : GuildChannel
    {
        $channel = $this->{$this->typeMethods[$data['type']]}($data);
        
        return $channel;
    }
    
    private function createDMChannel($data)
    {
        return DM::create(
            $this->extractId($data),
            $this->extractRecipient($data),
            $this->extractLastMessageId($data)
        );
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
    
    private function extractLastMessageId($data) : MessageId
    {
        return MessageId::create((int) $data['last_message_id']);
    }
    
    
    private function extractRecipient($data)
    {
        $recipients = $this->extractRecipients($data)->getIterator();

        return reset($recipients);
    }
    
    private function extractRecipients($data) : UserIdCollection
    {
        $recipients = array_map(
            function($recipient) {
                return UserId::create((int) $recipient['id']);
            },
            $data['recipients']
        );
        
        return new UserIdCollection(...$recipients);
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
