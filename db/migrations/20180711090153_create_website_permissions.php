<?php


use Phinx\Migration\AbstractMigration;

class CreateWebsitePermissions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $options = [
            'id' => false,
        ];
        
        $table = $this->table('guilds_websites_permissions', $options);
        $table->addColumn('guild_id', 'biginteger');
        $table->addColumn('role_id', 'biginteger');
        $table->addColumn('route_name', 'string');
        $table->addForeignKey('guild_id', 'guilds', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->addForeignKey('role_id', 'guilds_roles', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
        
        $this->execute("ALTER TABLE guilds_websites_permissions ADD CONSTRAINT uk_guilds_websites_permissions UNIQUE (role_id, route_name)");
    }
    
    public function down()
    {
        $this->execute('DROP TABLE guilds_websites_permissions');
    }
}
