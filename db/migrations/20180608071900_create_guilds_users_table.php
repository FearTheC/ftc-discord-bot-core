<?php


use Phinx\Migration\AbstractMigration;

class CreateGuildsUsersTable extends AbstractMigration
{
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => ['guild_id', 'user_id'],
        ];
        
        $table = $this->table('guilds_users', $options);
        $table->addColumn('guild_id', 'biginteger');
        $table->addColumn('user_id', 'biginteger');
        $table->addColumn('nickname', 'string', ['null' => true]);
        $table->addColumn('joined_date', 'datetime', ['timezone' => true, 'null' => true]);
        $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->addForeignKey('guild_id', 'guilds', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
    
}
