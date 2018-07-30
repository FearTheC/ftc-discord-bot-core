<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildChannelsTable extends AbstractMigration
{
    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('guilds_channels', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('guild_id', 'biginteger');
        $table->addColumn('name', 'text');
        $table->addColumn('position', 'integer');
        $table->addColumn('type_id', 'integer');
        $table->addColumn('permission_overwrite', 'jsonb');
        $table->addColumn('category_id', 'biginteger', ['null' => true]);
        $table->addColumn('is_active', 'boolean', ['default' => true]);
        $table->addForeignKey('guild_id', 'guilds');
        $table->addForeignKey('type_id', 'channels_types');
        $table->create();
        
    }

}
