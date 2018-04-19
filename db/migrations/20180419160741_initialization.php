<?php


use Phinx\Migration\AbstractMigration;

class Initialization extends AbstractMigration
{
    
    public function up()
    {
    	$sql = 'CREATE TABLE commands';
    	$sql .= ' (id serial, name text)';
    	
    	$this->execute($sql);
    }
    
    public function down()
    {
    	$this->execute('DROP TABLE commands');
    }
    
}
