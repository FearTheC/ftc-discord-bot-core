<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildsTable extends AbstractMigration
{
	
    public function up()
    {
    	$this->exec('CREATE TABLE guilds (id bigint, name string');
    }
    
    public function down()
    {
    	$this->execute('DROP TABLE guilds');
    }
    
}
