<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildsTable extends AbstractMigration
{
	
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('guilds', $options);
    	$table->addColumn('id', 'biginteger');
    	$table->addColumn('name', 'text');
    	$table->create();
    }
    
}
