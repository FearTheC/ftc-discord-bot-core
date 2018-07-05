<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildVoiceChannelsTable extends AbstractMigration
{
    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => 'channel_id'
        ];
        
        $table = $this->table('guilds_voice_channels', $options);
        $table->addColumn('channel_id', 'biginteger');
        $table->addColumn('bitrate', 'integer');
        $table->addColumn('user_limit', 'integer');
        $table->addForeignKey('channel_id', 'guilds_channels');
        $table->create();
    }

}
