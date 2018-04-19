<?php


use Phinx\Migration\AbstractMigration;

class CreateGamesTable extends AbstractMigration
{
	
    public function up()
    {
    	$this->exec('CREATE TABLE games (id serial, name text');
    }
    
    public function down()
    {
    	$this->exec('DROP TABLE games');
    }
    
}
