<?php declare(strict_types=1);

namespace FTCBotCore\Broker;

class MessageFactory
{
    
    public static function fromRawMessage($message)
    {
        $classname = self::resolveClassNameFromEvent($message['event']);
        return new $classname($message['data']);
    }
    
    private static function resolveClassNameFromEvent($eventName)
    {
        $nameParts = explode('_', $eventName);
        
        $classname = '';
        foreach ($nameParts as $namePart) {
            $namePart = strtolower($namePart);
            $namePart = ucfirst($namePart);
            $classname .= $namePart;
        }
        
        return __NAMESPACE__.'\\Message\\'.$classname;
    }
    
}
