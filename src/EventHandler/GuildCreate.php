<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

use FTCBotCore\Message\Message;
use FTCBotCore\Message\GuildCreate as GuildCreateMessage;
use FTC\Discord\Model\Aggregate\GuildRepository;
use FTC\Discord\Model\Guild;
use FTCBotCore\Discord\Model\Mapper\GuildFactory;
use FTCBotCore\Discord\Model\Mapper\UserFactory;
use FTC\Discord\Model\User;
use FTC\Discord\Model\Aggregate\UserRepository;

class GuildCreate 
{
    
    /**
     * @var GuildRepository
     */
    private $guildRepository;
    
    
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;
   
    
    public function __construct(GuildRepository $guildRepository, UserRepository $userRepository
     ) {
         $this->guildRepository = $guildRepository;
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

        $this->guildRepository->save($guild);
        
        return true;
    }

}
