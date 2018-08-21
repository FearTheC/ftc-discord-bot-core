<?php


use Phinx\Migration\AbstractMigration;

class CreateVocalPresenceTable extends AbstractMigration
{
    public function change()
    {
        $options = [
            'id' => false,
        ];
        
        $table = $this->table('members_vocal_presence', $options);
        $table->addColumn('channel_id', 'biginteger');
        $table->addColumn('member_id', 'biginteger');
        $table->addColumn('session_id', 'string', ['limit' => 32]);
        $table->addColumn('start_time', 'datetime', ['timezone' => true]);
        $table->addColumn('end_time', 'datetime', ['timezone' => true, 'null' => true]);
        
        $table->addForeignKey('member_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->addForeignKey('channel_id', 'guilds_channels', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        
        $table->addIndex(['member_id', 'channel_id', 'start_time'], ['unique' => true, 'name' => 'uk_vocal_presence']);
        
        $table->create();
    }
    
}
