<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Message\Factory;

use FTC\Discord\Model\GuildMember;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\NickName;

class GuildMemberFactory
{
    
    public function create($data) {
        $rolesIds = $data['roles'];
        
        $nickname = null;
        if (isset($data['nick'])) {
            $nickname = NickName::create($data['nick']);
        }
        return GuildMember::create(
            UserId::create((int) $data['user']['id']),
            $rolesIds,
            new \DateTime($data['joined_at']),
            $nickname
            );
    }
    
}
