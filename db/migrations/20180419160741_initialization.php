<?php


use Phinx\Migration\AbstractMigration;

class Initialization extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('commands');
        $table->addColumn('name', 'text');
        $table->create();
    }
    
}
