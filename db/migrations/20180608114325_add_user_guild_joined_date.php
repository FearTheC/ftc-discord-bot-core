<?php


use Phinx\Migration\AbstractMigration;

class AddUserGuildJoinedDate extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('guilds_users');
        $table->addColumn('joined_date', 'datetime', ['timezone' => true, 'null' => true]);
        $table->update();
    }
}
