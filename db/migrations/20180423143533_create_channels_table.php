<?php


use Phinx\Migration\AbstractMigration;

class CreateChannelsTable extends AbstractMigration
{
    
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('channels', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('parent_id', 'biginteger');
        $table->addColumn('guild_id', 'biginteger');
        $table->addColumn('type_id', 'integer');
        $table->addColumn('name', 'text');
        $table->addForeignKey('type_id', 'channels_types');
        $table->addForeignKey('parent_id', 'channels');
        $table->addForeignKey('guild_id', 'guilds');
        $table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE channels');
    }
    
}
