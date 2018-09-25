<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\Collection\GuildRoleIdCollection;
use FTC\Discord\Model\ValueObject\Name\NickName;
use FTC\Discord\Model\Aggregate\GuildMember;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\UserRepository;
use FTC\Discord\Model\Aggregate\User;

class GuildMemberAdd 
{
    
    /**
     * @var GuildMemberRepository
     */
    private $guildMemberRepository;
    
    /**
     * @var UserRepository
     */
    private $userRepository;
    

    public function __construct(
        GuildMemberRepository $guildMemberRepository,
        UserRepository $userRepository
    ) {
        $this->guildMemberRepository= $guildMemberRepository;
        $this->userRepository = $userRepository;
    }
    
    public function __invoke(Message $message)
    {
        $userId = UserId::create((int) $message->getUserId());
        $guildId = GuildId::create((int) $message->getGuildId());
        $rolesIds = array_map(function($roleId) { return RoleId::create((int) $roleId); }, $message->getUserRoles());
        $rolesIdsColl = new GuildRoleIdCollection(...$rolesIds);
        if (!$nickname = $message->getData()['nick']) {
            $nickname = $message->getData()['user']['username'];
        }
        $nickname = NickName::create($nickname);
        
        $member = GuildMember::register($userId, $rolesIdsColl, $nickname);
        $user = User::fromArray($message->getData()['user']);
        
        $this->userRepository->save($user);
        $this->guildMemberRepository->save($member, $guildId);

        return true;
    }

}
