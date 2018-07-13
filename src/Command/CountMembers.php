<?php
namespace FTCBotCore\Command;

use FTCBotCore\Message\MessageCreate;
use FTCBotCore\Discord\Client;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;

class CountMembers
{
    
    /**
     * @var GuildMemberRepository $guildMemberRepository
     */
    private $guildMemberRepository;
    
    /**
     * @var GuildRoleRepository $guildRoleRepository
     */
    private $guildRoleRepository;
    
    /**
     * @var Client $discordClient
     */
    private $discordClient;
    
    public function __construct(GuildMemberRepository $guildMemberRepository, GuildRoleRepository $guildRoleRepository, Client $discordClient)
    {
        $this->guildMemberRepository = $guildMemberRepository;
        $this->guildRoleRepository = $guildRoleRepository;
        $this->discordClient = $discordClient;
    }
    
    public function __invoke(MessageCreate $msg)
    {
        $requestedRoles = $this->getRolesInArgs($msg);
        $guildId= GuildId::create($msg->getGuildId());

        if ($requestedRoles) {
            $results = $this->getRoleCount($guildId, $requestedRoles);
        } else {
            $results = $this->getAvailableRoleArgs($guildId);
        }

        $results = 'Hey <@'.$msg->getAuthorId().'>!'.PHP_EOL.$results;
//         $this->discordClient->deleteMessage($msg);
        $this->discordClient->answer($results, $msg->getChannelId());
    }
    
    private function getRolesInArgs(MessageCreate $msg)
    {
        $argsString = strstr($msg->getContent(), ' ');
        $args = array_map('trim', explode(',', $argsString));
        return $args;
    }
    
    private function getRoleCount(GuildId $guildId, array $args)
    {
        $roles = $args;
        foreach ($args as $key => $arg) {
            $args[$key] = "'".$arg."'";
        }
        
        $results = $this->guildMemberRepository->countByRole($guildId, $args);
        
        $str = '';
        foreach ($results as $row) {
            if (in_array($row['name'], $roles)) {
                $str .= $row['name'].': '.$row['count'].PHP_EOL;
                unset($roles[array_search($row['name'], $roles)]);
            }
        }
        
        if (!empty($roles)) {
            $str .= 'Following roles doesn\'t exist, please check their spelling: '.implode(', ', $roles).PHP_EOL;
        }
        
        return $str;
    }
    
    private function getAvailableRoleArgs(GuildId $guildId)
    {
        $results = $this->guildRoleRepository->getAvalaibleRoles($guildId);
        $str = 'Please select at least one of the following roles : '.implode(', ', $results);
        
        return $str;
    }
}
