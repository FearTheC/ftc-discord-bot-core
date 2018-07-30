<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Model\Mapper;

use FTC\Discord\Model\Aggregate\GuildMember;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Name\NickName;
use FTC\Discord\Model\Collection\GuildRoleIdCollection;

class GuildMemberFactory
{
    
    public function create($data) {
        $rolesIds = array_map(
            function($value) {
                return RoleId::create((int) $value);
            },
            $data['roles']
        );
        $roleIdsColl = new GuildRoleIdCollection(...$rolesIds);
        
        $nickname = null;
        if (isset($data['nick'])) {
            $nickname = NickName::create($data['nick']);
        }
        if (!$nickname) {
            $nickname = NickName::create($data['user']['username']);
        }
        return GuildMember::create(
            UserId::create((int) $data['user']['id']),
            $roleIdsColl,
            new \DateTime($data['joined_at']),
            $nickname
            );
    }
    
}
