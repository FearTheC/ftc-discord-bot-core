<?php

use Phinx\Migration\AbstractMigration;

class CreateGroupDmChannel extends AbstractMigration
{

    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('group_dm_channels', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('is_active', 'boolean', ['default' => true]);
        $table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE group_dm_channels');
    }

}
