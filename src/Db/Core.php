<?php
namespace FTCBotCore\Db;

class Core
{
    
    private $connection;
    
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    
}
