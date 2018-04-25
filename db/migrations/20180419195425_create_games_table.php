<?php


use Phinx\Migration\AbstractMigration;

class CreateGamesTable extends AbstractMigration
{
	
    public function up()
    {
        $this->execute('CREATE TABLE games (id serial, name text)');
        $this->execute('ALTER TABLE games ADD CONSTRAINT uc_games_name UNIQUE (name)');
    }
    
    public function down()
    {
    	$this->execute('DROP TABLE games');
    }
    
}
