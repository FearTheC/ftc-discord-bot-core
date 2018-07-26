<?php declare(strict_types=1);
namespace FTCBotCore\Container\EventHandler;

use Psr\Container\ContainerInterface;
use FTCBotCore\EventHandler\MessageCreate as MessageCreateInstance;
use FTCBotCore\Command\Dispatcher;
use FTC\Discord\Model\Aggregate\GuildMessageRepository;

class MessageCreate
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $httpClient = $container->get('discord-http-client');
        $dispatcher = $container->get(Dispatcher::class);
        $messageRepository = $container->get(GuildMessageRepository::class);

        return new MessageCreateInstance($httpClient, $dispatcher, $messageRepository);
    }
    
}
