<?php


use Phinx\Migration\AbstractMigration;

class CreateRolesTable extends AbstractMigration
{
	
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => ['id'],
        ];
        
        $table = $this->table('guilds_roles', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('guild_id', 'biginteger');
        $table->addColumn('name', 'text');
        $table->addForeignKey('guild_id', 'guilds');
        $table->create();
    }
    
}
