<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTCBotCore\Discord\Model\Mapper\AbstractChannelFactory;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\Channel\DMChannel\DMRepository;
use FTC\Discord\Model\Aggregate\GuildChannel;
use FTC\Discord\Model\Channel\DMChannel\DM;

class ChannelCreate 
{
    
    /**
     * @var GuildChannelRepository
     */
    private $channelRepository;
    
    /**
     * @var DMRepository
     */
    private $dmRepository;
    
    private $funToCall = [
        GuildChannel::GUILD_TEXT => 'saveGuildChannel',
        GuildChannel::GUILD_VOICE => 'saveGuildChannel',
        GuildChannel::DM => 'saveDmChannel',
        GuildChannel::GROUP_DM => 'saveGroupDmChannel',
    ];
    
    public function __construct(GuildChannelRepository $channelRepository, DMRepository $dmRepository) {
        $this->channelRepository= $channelRepository;
        $this->dmRepository = $dmRepository;
    }

    public function __invoke(Message $message)
    {
        $data = $message->getData();
        $channelFactory = new AbstractChannelFactory();
        $channel = $channelFactory->create($data);
        
        $guildId = null;
        if (isset($data['guild_id'])) {
            $guildId = GuildId::create((int) $data['guild_id']);
        }
            
        $this->{$this->funToCall[$channel->getTypeId()]}($channel, $guildId);
        
        return true;
    }
    
    private function saveGuildChannel(\FTC\Discord\Model\Channel\GuildChannel $channel, GuildId $guildId)
    {
        $this->channelRepository->save($channel, $guildId);
    }
    
    private function saveDmChannel(DM $channel)
    {
        $this->dmRepository->save($channel);
    }
    
}
