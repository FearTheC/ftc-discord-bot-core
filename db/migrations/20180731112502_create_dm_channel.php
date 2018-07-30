<?php

use Phinx\Migration\AbstractMigration;

class CreateDmChannel extends AbstractMigration
{
    
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('dm_channels', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('recipient_id', 'biginteger');
        $table->addColumn('last_message_id', 'biginteger');
        $table->addColumn('is_active', 'boolean', ['default' => true]);
        $table->addForeignKey('recipient_id', 'users');
        $table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE dm_channels');
    }
    
}
