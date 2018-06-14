<?php
namespace FTCBotCore\Command;


use FTCBotCore\Discord\Model\GuildMemberRepository;
use FTCBotCore\Discord\Message;
use FTCBotCore\Discord\Client;
use FTCBotCore\Discord\Model\GuildRoleRepository;
use FTCBotCore\Discord\Message\MessageCreate;
use FTCBotCore\EventHandler\EventHandler;

class AddMemberRole extends EventHandler
{

    /**
     * @var GuildMemberRepository
     */
    private $memberRepository;
    
    /**
     * @var Client
     */
    private $client;
    
    /**
     * @var GuildRoleRepository
     */
    private $guildRoleRepository;
    
    public function __construct(
        GuildMemberRepository $memberRepository,
        GuildRoleRepository $guildRoleRepository,
        Client $discordClient
        ) {
        $this->memberRepository = $memberRepository;
        $this->guildRoleRepository = $guildRoleRepository;
        $this->discordClient = $discordClient;
    }
    
    public function __invoke(MessageCreate $message)
    {
        $args = explode(' ', $message->getContent());
        $roleId = $this->getDiscordIdentifier($args[1]);
        $memberId = $this->getDiscordIdentifier($args[2]);
//         var_dump($this->getDiscordIdentifier($args[1]), $message->getGuildId());
//         $role = $this->guildRoleRepository->findByName($args[1], $message->getGuildId());
            
//             var_dump($role);

        
        
        $results = 'Hey <@'.$message->getAuthorId().'>!'.PHP_EOL."sdfsdfsdf";
        
        $this->discordClient->deleteMessage($message);
        $this->discordClient->answer($results, $message->getChannelId());
    }
    
}
