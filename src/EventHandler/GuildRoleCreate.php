<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\Aggregate\GuildRole;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Name\RoleName;
use FTC\Discord\Model\ValueObject\Permission;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;
use FTC\Discord\Model\ValueObject\Color;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class GuildRoleCreate 
{
    
    /**
     * @var GuildRoleRepository
     */
    private $repository;
    

    public function __construct(
        GuildRoleRepository $repository
    ) {
        $this->repository= $repository;
    }

    public function __invoke(Message $message)
    {
        $data = $message->getData();
        $id = RoleId::create((int) $data['role']['id']);
        $name = RoleName::create($data['role']['name']);
        $color = Color::createFromInteger((int) $data['role']['color']);
        $permissions = Permission::create((int) $data['role']['permissions']);
        $position = $data['role']['position'];
        $mentionnable = $data['role']['mentionable'];
        $hoist = $data['role']['hoist'];
        
        $role = GuildRole::create($id, $name, $color, $permissions, $position, $mentionnable, $hoist);
        
        $this->repository->save($role, GuildId::create((int) $data['guild_id']));
        
        return true;
    }

}
