<?php


use Phinx\Migration\AbstractMigration;

class CreateRolesTable extends AbstractMigration
{
	
    public function up()
    {
    	$this->exec('CREATE TABLE guilds_roles (id bigint, guild_id bigint, name text');
    }
    
    public function down()
    {
    	$this->exec('DROP TABLE guilds_roles');
    }
    
}
