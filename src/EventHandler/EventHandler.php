<?php declare(strict_types=1);

namespace FTCBotCore\EventHandler;

abstract class EventHandler
{
    
    
    protected function getDiscordIdentifier(string $string)
    {
        preg_match('/<@([0-9]{16,20})>/', $string, $match);
        $trimmed = trim($string, '<@>');
        return $match[1];
    }
}
