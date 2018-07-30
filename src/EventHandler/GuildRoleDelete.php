<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;

class GuildRoleDelete 
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
        $id = RoleId::create((int) $data['role_id']);
        
        $this->repository->delete($id);
        
        return true;
    }

}
