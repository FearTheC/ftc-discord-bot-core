<?php
namespace FTCBotCore\Command;

use FTCBotCore\Discord\Model\GuildMemberRepository;
use FTCBotCore\Discord\Model\GuildMember;

class CreateGuildMember
{
    
    private $repository;
    
    public function __construct(GuildMemberRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function __invoke(GuildMember $member)
    {
        $this->repository->add($member);
    }
    
}
