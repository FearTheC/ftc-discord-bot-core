<?php


use Phinx\Migration\AbstractMigration;

class AddPlatadminRoles extends AbstractMigration
{
    const INSERT_ROLE_Q = <<<'EOT'
INSERT INTO platadmin_roles (name)
VALUES ('%s')
EOT;
    
    private $roles = [
        'administrator',
        'developer',
        'manager',
    ];

    public function change()
    {
        $table = $this->table('platadmin_roles');
        $table->addColumn('name', 'text');
        $table->create();
        
        foreach ($this->roles as $role) {
            $this->execute(sprintf(self::INSERT_ROLE_Q, $role));
        }
    }
}
