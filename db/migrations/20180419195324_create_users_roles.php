<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersRoles extends AbstractMigration
{
    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => ['user_id', 'role_id'],
        ];
        
        $table = $this->table('users_roles', $options);
        $table->addColumn('user_id', 'biginteger');
        $table->addColumn('role_id', 'biginteger');
        $table->addForeignKey('user_id', 'users');
        $table->addForeignKey('role_id', 'guilds_roles');
        $table->create();
    }
    
}
