<?php

declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTCBotCore\Message\GuildCreate as GuildCreateMessage;
use FTC\Discord\Model\Guild;
use FTCBotCore\Discord\Model\Mapper\GuildFactory;
use FTCBotCore\Discord\Model\Mapper\UserFactory;
use FTC\Discord\Model\User;
use FTC\Discord\Model\Aggregate\UserRepository;
use FTC\Discord\Model\Service\GuildCreation;
use FTCBotCore\Discord\Model\Mapper\GuildRoleFactory;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTCBotCore\Discord\Model\Mapper\GuildMemberFactory;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTCBotCore\Discord\Model\Mapper\AbstractChannelFactory;
use FTC\Discord\Model\Collection\GuildChannelCollection;

class GuildCreate 
{
    
    /**
     * @var GuildCreation
     */
    private $guildCreationService;
    
    
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;
   
    
    public function __construct(GuildCreation $guildCreationService, UserRepository $userRepository
     ) {
         $this->guildCreationService= $guildCreationService;
        $this->userRepository = $userRepository;
    }
    
    
    public function __invoke(GuildCreateMessage $message) {
        $userFactory = new UserFactory();
        $repo = $this->userRepository;
        array_walk($message->getData()['members'], function($member) use ($userFactory) {
            $user = $userFactory->create($member['user']);
            $this->userRepository->save($user);
        });

        $guildFactory = new GuildFactory();
        $guild = $guildFactory->fromMessage($message);

        $guildRoleFactory = new GuildRoleFactory();
        $roles = array_map([$guildRoleFactory, 'create'], $message->getData()['roles']);
        $rolesColl = new GuildRoleCollection(...$roles);
        
        $guildMemberFactory = new GuildMemberFactory();
        $members = array_map([$guildMemberFactory, 'create'], $message->getData()['members']);
        $membersColl = new GuildMemberCollection(...$members);
        
        $channelFactory = new AbstractChannelFactory();
        $channels = array_map([$channelFactory, 'create'], $message->getData()['channels']);
        $channelsColl = new GuildChannelCollection(...$channels);

        call_user_func($this->guildCreationService, $guild, $rolesColl, $membersColl, $channelsColl);
        
        return true;
    }

}
