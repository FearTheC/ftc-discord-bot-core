<?php
namespace FTCBotCore\Command;

use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\GuildMember;

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
