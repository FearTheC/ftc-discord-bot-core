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
        $table->addForeignKey('user_id', 'users');
        $table->addForeignKey('guild_id', 'guilds');
        $table->create();
    }
    
}
