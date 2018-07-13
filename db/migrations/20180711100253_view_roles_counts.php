<?php


use Phinx\Migration\AbstractMigration;

class ViewRolesCounts extends AbstractMigration
{
    const VIEW_CREATION = <<<'EOT'
CREATE OR REPLACE VIEW view_roles_counts AS
SELECT roles.id, roles.guild_id, roles.name, count(members_roles.user_id)
FROM members_roles
JOIN guilds_roles roles on roles.id = members_roles.role_id
GROUP BY roles.name, roles.id, roles.guild_id;
EOT;

    public function up()
    {
        $this->execute(self::VIEW_CREATION);
    }
    
    public function down()
    {
        $this->execute('DROP VIEW view_roles_counts');
    }
    
}
