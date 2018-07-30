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
        $table->addColumn('color', 'integer');
        $table->addColumn('position', 'integer');
        $table->addColumn('permissions', 'biginteger');
        $table->addColumn('is_mentionable', 'boolean');
        $table->addColumn('is_hoisted', 'boolean');
        $table->addColumn('is_active', 'boolean', ['default' => true]);
        $table->addForeignKey('guild_id', 'guilds', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
    
}
