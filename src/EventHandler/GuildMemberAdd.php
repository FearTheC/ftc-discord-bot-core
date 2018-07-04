<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\GuildMemberRepository;
use FTC\Discord\Model\GuildMember;

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

}
