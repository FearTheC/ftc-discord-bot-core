<?php


use Phinx\Migration\AbstractMigration;

class CreateGamesTable extends AbstractMigration
{
	
    public function up()
    {
    	$this->execute('CREATE TABLE games (id serial, name text)');
    }
    
    public function down()
    {
    	$this->execute('DROP TABLE games');
    }
    
}
