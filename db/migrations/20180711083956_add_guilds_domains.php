<?php


use Phinx\Migration\AbstractMigration;

class AddGuildsDomains extends AbstractMigration
{
    
    public function change()
    {
        
        $options = [
            'id' => false,
            'primary_key' => ['guild_id'],
        ];
        
        $table = $this->table('guilds_domains', $options);
        $table->addColumn('guild_id', 'biginteger');
        $table->addColumn('domain', 'text');
        $table->addColumn('is_active', 'boolean', ['default' => true]);
        $table->addForeignKey('guild_id', 'guilds', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
}
