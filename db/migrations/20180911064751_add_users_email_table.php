<?php


use Phinx\Migration\AbstractMigration;

class AddUsersEmailTable extends AbstractMigration
{
    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => ['user_id'],
        ];
        
        $table = $this->table('users_email', $options);
        $table->addColumn('user_id', 'biginteger');
        $table->addColumn('email', 'text');
        $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
}
