<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildTextChannelsTable extends AbstractMigration
{
    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => 'channel_id'
        ];
        
        $table = $this->table('guilds_text_channels', $options);
        $table->addColumn('channel_id', 'biginteger');
        $table->addColumn('topic', 'text');
        $table->addForeignKey('channel_id', 'guilds_channels');
        $table->create();
    }

}
