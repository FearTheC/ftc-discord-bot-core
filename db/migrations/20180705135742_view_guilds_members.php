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
        CASE
            WHEN count(mroles.id) = 0 THEN '[]'::jsonb
            ELSE JSONB_AGG((SELECT x FROM (SELECT mroles.id, mroles.name, mroles.permissions) AS x)) 
        END AS roles
    FROM guilds_users members
    LEFT OUTER JOIN (
        SELECT mr.user_id, gr.guild_id, gr.id, gr.name, gr.permissions
        FROM members_roles mr
        JOIN guilds_roles gr ON gr.id = mr.role_id
    ) as mroles on mroles.user_id = members.user_id and mroles.guild_id = members.guild_id
    WHERE members.is_active = true
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
