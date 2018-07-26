<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildMessageTable extends AbstractMigration
{

    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('channels_messages', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('channel_id', 'biginteger');
        $table->addColumn('author_id', 'biginteger');
        $table->addColumn('type', 'integer');
        $table->addColumn('creation_time', 'datetime', ['timezone' => true]);
        $table->addColumn('update_time', 'datetime', ['timezone' => true, 'null' => true]);
        $table->addColumn('is_pinned', 'boolean', ['default' => false]);
        $table->addColumn('content', 'text');
        
        $table->addForeignKey('author_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->addForeignKey('channel_id', 'guilds_channels', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        
        $table->create();
    }
    
}
