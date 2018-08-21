<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\Service\VocalPresenceService;
use FTCBotCore\Message\VoiceStateUpdate as VoiceStateUpdateMessage;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Hash\MD5;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class VoiceStateUpdate
{
    
    /**
     * @var VocalPresenceService
     */
    private $vocalPresenceService;
    
    
    public function __construct(VocalPresenceService $vocalPresenceService) {
            $this->vocalPresenceService = $vocalPresenceService;
    }
    
    
    public function __invoke(VoiceStateUpdateMessage $message) : void
    {
        $data = $message->getData();
        
        $memberId = UserId::create((int) $data['user_id']);
        $sessionId = MD5::create($data['session_id']);
        $guildId = GuildId::create((int) $data['guild_id']);
        $channelId = null;
        if ($data['channel_id']) {
            $channelId = ChannelId::create((int) $data['channel_id']);
        }
        
        $this->vocalPresenceService->update($memberId, $guildId, $channelId, $sessionId);
    }
    
}
