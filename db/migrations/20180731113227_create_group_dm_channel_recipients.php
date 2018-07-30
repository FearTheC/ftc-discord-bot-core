<?php

use Phinx\Migration\AbstractMigration;

class CreateGroupDmChannelRecipients extends AbstractMigration
{
    
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => ['channel_id', 'user_id']
        ];
        
        $table = $this->table('group_dm_channels_recipients', $options);
        $table->addColumn('channel_id', 'biginteger');
        $table->addColumn('user_id', 'biginteger');
        $table->addForeignKey('channel_id', 'group_dm_channels');
        $table->addForeignKey('user_id', 'users');
        $table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE group_dm_channels_recipients');
    }
    
}
