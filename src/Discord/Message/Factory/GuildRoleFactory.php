<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Message\Factory;

use FTC\Discord\Message;
use FTC\Discord\Model\GuildRole;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Name\RoleName;
use FTC\Discord\Model\ValueObject\Permission;
use FTC\Discord\Model\ValueObject\Color;

class GuildRoleFactory
{
    
    public function create($data){
        return GuildRole::create(
            RoleId::create((int) $data['id']),
            RoleName::create($data['name']),
            Color::createFromInteger($data['color']),
            new Permission($data['permissions']),
            (int) $data['position'],
            (bool) $data['mentionable'],
            (bool) $data['hoist']
            );
    }
    
}
