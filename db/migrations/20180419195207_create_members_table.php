<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
	
    public function up()
    {
    	$this->exec('CREATE TABLE users (id bigint, username text');
    }
    
    public function down()
    {
    	$this->exec('DROP TABLE users');
    }
    
}
