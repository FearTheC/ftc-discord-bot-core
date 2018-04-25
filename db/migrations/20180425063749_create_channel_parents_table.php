<?php


use Phinx\Migration\AbstractMigration;

class CreateChannelParentsTable extends AbstractMigration
{
    
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => ['channel_id', 'parent_id'],
        ];
        
        $table = $this->table('channels_parents', $options);
        $table->addColumn('channel_id', 'biginteger');
        $table->addColumn('parent_id', 'biginteger');
        $table->addForeignKey('channel_id', 'channels');
        $table->addForeignKey('parent_id', 'channels');
        $table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE channels_parents');
    }
    
}
