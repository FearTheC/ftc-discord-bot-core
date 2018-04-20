<?php


use Phinx\Migration\AbstractMigration;

class CreatePresenceTable extends AbstractMigration
{
	
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
    	$table = $this->table('presence', $options);
    	$table->addColumn('id', 'biginteger');
    	$table->addColumn('type_id', 'integer');
    	$table->addForeignKey('type_id', 'presence_types');
    	$table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE presence');
    }
    
    
}
