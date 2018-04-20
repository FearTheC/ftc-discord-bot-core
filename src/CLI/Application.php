<?php declare(strict_types=1);

namespace FTCBotCore\CLI;

use Symfony\Component\Console\Application;

class Application extends Application
{
    
    const APPLICATION_NAME = 'bot_core';
    
    public function __construct(string $version = 'UNKNOWN')
    {
        parent::__construct(self::APPLICATION_NAME);
    }
    
}
