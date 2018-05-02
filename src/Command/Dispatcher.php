<?php
namespace FTCBotCore\Command;

class Dispatcher
{
    
    private $commands;
    
    public function __construct()
    {
        
    }
    
    public function add($name, $command)
    {
        $this->commands[$name] = $command;
    }
    
    public function has($name)
    {
        return (isset($this->commands[$name]));
    }
    
    public function get($name)
    {
        if (!$this->has($name)) {
            return false;
        }
        
        return $this->commands[$name];
    }
    
}
