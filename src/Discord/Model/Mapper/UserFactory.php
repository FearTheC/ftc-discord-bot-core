<?php declare(strict_types=1);

namespace FTCBotCore\Discord\Model\Mapper;

use FTC\Discord\Model\Aggregate\User;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\UserName;
use FTC\Discord\Model\ValueObject\DiscordTag;
use FTC\Discord\Model\ValueObject\Email;

class UserFactory
{
    
    public function create($data)
    {
        $email = null;
        if(isset($data['email'])) {
            $email = Email::create($data['email']);
        }
        $isBot = false;
        if (isset($data['bot'])) {
            $isBot = true;
        }
        return User::create(
            UserId::create((int) $data['id']),
            UserName::create($data['username']),
            DiscordTag::create($data['discriminator']),
            $email,
            $isBot
        );
    }
    
}
