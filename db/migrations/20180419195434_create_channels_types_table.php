<?php


use Phinx\Migration\AbstractMigration;

class CreateChannelsTypesTable extends AbstractMigration
{
	
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('channels_types', $options);
    	$table->addColumn('id', 'integer');
    	$table->addColumn('name', 'text');
    	$table->create();

        $this->insert('channels_types', $this->rows);
}

    public function down()
    {
        $this->execute('DELETE FROM channels_types');
        $this->execute('DROP TABLE channels_types');
    }
    
    private $rows = [
        [
            'id' => 0,
            'name' => 'guild_text',
        ],
        [
            'id' => 1,
            'name' => 'dm',
        ],
        [
            'id' => 2,
            'name' => 'guild_voice',
        ],
        [
            'id' => 3,
            'name' => 'group_dm',
        ],
        [
            'id' => 4,
            'name' => 'guild_category',
        ],
    ];
    
}
