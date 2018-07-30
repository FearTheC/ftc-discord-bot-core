<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\GuildMemberUpdate as GuildMemberUpdateMessage;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildMember;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\Collection\GuildRoleIdCollection;
use FTC\Discord\Model\ValueObject\Name\NickName;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class GuildMemberUpdate 
{
    
    /**
     * @var GuildMemberRepository
     */
    private $memberRepository;
    
    public function __construct(GuildMemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }
    

    public function __invoke(GuildMemberUpdateMessage $message)
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

        $this->memberRepository->save($member, $guildId);
        
    }

}
