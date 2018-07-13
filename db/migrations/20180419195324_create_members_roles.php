<?php


use Phinx\Migration\AbstractMigration;

class CreateMembersRoles extends AbstractMigration
{
    
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => ['user_id', 'role_id'],
        ];
        
        $table = $this->table('members_roles', $options);
        $table->addColumn('user_id', 'biginteger');
        $table->addColumn('role_id', 'biginteger');
        $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->addForeignKey('role_id', 'guilds_roles', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
    
}
