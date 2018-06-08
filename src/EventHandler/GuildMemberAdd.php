<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use GuzzleHttp\ClientInterface;
use FTCBotCore\Command\Dispatcher;
use FTCBotCore\Discord\Message;
use FTCBotCore\Db\DbCacheInterface;
use FTCBotCore\Discord\Model\GuildMemberRepository;
use FTCBotCore\Discord\Model\GuildMember;

class GuildMemberAdd 
{
    
    const ADD_USER_Q = "INSERT INTO users VALUES (:user_id, :username) ON CONFLICT ON CONSTRAINT users_pkey DO NOTHING";
    const ADD_GUILD_USER_Q = "INSERT INTO guilds_users VALUES (:guild_id, :user_id)";
    
    /**
     * @var GuildMemberRepository
     */
    private $repository;
    

    public function __construct(
        GuildMemberRepository $repository
    ) {
        $this->repository= $repository;
    }
    
    public function __invoke(Message $message)
    {
        $guildId = $message->getGuildId();
        
        $member = GuildMember::register($message->getUserId(), $message->getUsername());
        
        $this->repository->add($member);
        $this->repository->addGuild($member, $guildId);

        return true;
    }
    
    private function hasCommand($message)
    {
        return (substr($message, 0, 1) == '!');
    }

}
