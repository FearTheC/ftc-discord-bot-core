<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
	
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => 'id'
        ];
        
        $table = $this->table('users', $options);
        $table->addColumn('id', 'biginteger');
        $table->addColumn('username', 'text');
        $table->create();
    }
    
}
