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
    	$table->addColumn('owner_id', 'biginteger');
    	$table->addColumn('joined_date', 'datetime', ['timezone' => true, 'default' => 'CURRENT_TIMESTAMP']);
    	$table->addColumn('is_active', 'boolean', ['default' => true]);
    	$table->addForeignKey('owner_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
    	$table->create();
    }
    
}
