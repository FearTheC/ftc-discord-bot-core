<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildMember;

class GuildMemberAdd 
{
    
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
        $userId = UserId::create((int) $message->getUserId());
        $guildId = GuildId::create((int) $message->getGuildId());
        $rolesIds = array_map(function($roleId) { return RoleId::create((int) $roleId); }, $message->getUserRoles());
        $rolesIdsColl = new GuildRoleIdCollection(...$rolesIds);
        if (!$nickname = $message->getData()['nick']) {
            $nickname = $message->getData()['user']['username'];
        }
        $nickname = NickName::create($nickname);
        
        $member = GuildMember::register($userId, $rolesIdsColl, $nickname);
        
        $this->repository->save($member, $guildId);

        return true;
    }

}
