<?php


use Phinx\Migration\AbstractMigration;

class ViewGuildsMembers extends AbstractMigration
{
    
    const VIEW_CREATION = <<<'EOT'
CREATE VIEW view_guilds_members AS
    SELECT
        members.user_id AS id,
        members.guild_id,
        COALESCE(members.nickname, (SELECT username from users where users.id = members.user_id)) AS nickname,
        members.joined_date,
        JSONB_AGG((SELECT x FROM (SELECT guilds_roles.id, guilds_roles.permissions, guilds_roles.name FROM guilds_roles WHERE guilds_roles.id = members_roles.role_id) as x)) as roles
    FROM guilds_users members
    JOIN members_roles members_roles ON members_roles.user_id = members.user_id
    GROUP BY members.user_id, members.guild_id, members.nickname, members.joined_date;
EOT;

    public function up()
    {
        $this->execute(self::VIEW_CREATION);
    }
    
    public function down()
    {
        $this->execute('DROP VIEW view_guilds_members');
    }
    
}
