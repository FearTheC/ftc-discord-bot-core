<?php


use Phinx\Migration\AbstractMigration;

class InsertPresenceTypes extends AbstractMigration
{
    
    public function up()
    {        
        $this->insert('presence_types', $this->rows);
    }
    
    public function down()
    {
        $this->execute('DELETE FROM presence_types');
    }
    
    private $rows = [
        [
            'id' => 0,
            'name' => 'game',
        ],
        [
            'id' => 1,
            'name' => 'streaming',
        ],
        [
            'id' => 2,
            'name' => 'listening',
        ]
    ];
    
}
