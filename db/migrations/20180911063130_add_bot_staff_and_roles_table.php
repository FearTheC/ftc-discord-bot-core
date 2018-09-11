<?php

use Phinx\Migration\AbstractMigration;

class AddBotStaffAndRolesTable extends AbstractMigration
{

    public function up()
    {
        $roleTable = $this->table('bot_staff_roles');
        $roleTable->addColumn('name', 'string');
        $roleTable->addColumn('permission', 'biginteger');
        $roleTable->create();
        
        $options = [
            'id' => false,
            'primary_key' => ['user_id', 'bot_staff_role_id'],
        ];
        
        $staffTable = $this->table('bot_staff_users', $options);
        $staffTable->addColumn('user_id', 'biginteger');
        $staffTable->addColumn('bot_staff_role_id', 'biginteger');
        $staffTable->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $staffTable->addForeignKey('bot_staff_role_id', 'bot_staff_roles', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $staffTable->create();
        
        foreach ($this->staffRoles as $staffRole) {
            $this->insert($roleTable, $staffRole);
        }
    }
    
    public function down()
    {
        $this->execute('DROP TABLE bot_staff_users');
        $this->execute('DROP TABLE bot_staff_roles');
    }
    
    private $staffRoles = [
        [
            'name' => 'administrator',
            'permission' => 1,
        ],
        [
            'name' => 'developper',
            'permission' => 1,
        ],
    ];
}
