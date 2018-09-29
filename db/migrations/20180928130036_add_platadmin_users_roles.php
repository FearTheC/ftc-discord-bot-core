<?php


use Phinx\Migration\AbstractMigration;

class AddPlatadminUsersRoles extends AbstractMigration
{
    public function up()
    {
        $options = [
            'id' => false,
            'primary_key' => ['user_id', 'platadmin_role_id'],
        ];
        
        $table = $this->table('platadmin_users_roles', $options);
        $table->addColumn('user_id', 'biginteger');
        $table->addColumn('platadmin_role_id', 'biginteger');
        $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->addForeignKey('platadmin_role_id', 'platadmin_roles', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
}
