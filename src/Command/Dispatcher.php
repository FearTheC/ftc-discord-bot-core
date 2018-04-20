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
        var_dump($name);
        $this->commands[$name] = $command;
    }
    
    public function had($name)
    {
        return (isset($this->commands[$name]));
    }
    
    public function get($name)
    {
        return $this->commands[$name];
    }
    
}
