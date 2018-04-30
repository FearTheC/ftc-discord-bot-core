<?php declare(strict_types=1);

namespace FTCBotCore\Discord;

class MessageFactory
{
    
    public function __invoke($message)
    {
        $classname = $this->resolveClassNameFromEvent($message['event']);
        return new $classname($message);
    }
    
    private function resolveClassNameFromEvent($eventName)
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
