<?php


use Phinx\Migration\AbstractMigration;

class CreatePresenceTypes extends AbstractMigration
{
    
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('presence_types', $options);
        $table->addColumn('id', 'integer');
        $table->addColumn('name', 'text');
        $table->create();
    }
    
}
