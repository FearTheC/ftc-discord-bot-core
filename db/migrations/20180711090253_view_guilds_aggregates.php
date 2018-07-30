<?php


use Phinx\Migration\AbstractMigration;

class ViewGuildsAggregates extends AbstractMigration
{
    const VIEW_CREATION = <<<'EOT'
CREATE OR REPLACE VIEW guilds_aggregates AS
SELECT guilds.id, guilds.name, guilds_domains.domain, guilds.owner_id, guilds.joined_date,
    COALESCE(jsonb_agg(DISTINCT guilds_users.user_id) FILTER (WHERE guilds_users.user_id IS NOT NULL), '[]')  as members_ids,
    COALESCE(jsonb_agg(DISTINCT guilds_roles.id) FILTER (WHERE guilds_roles.id IS NOT NULL), '[]')  AS roles_ids,
    COALESCE(jsonb_agg(DISTINCT guilds_channels.id) FILTER (WHERE guilds_channels.id IS NOT NULL), '[]')  as channels_ids
FROM guilds
LEFT JOIN guilds_users ON guilds_users.guild_id = guilds.id
LEFT JOIN guilds_roles ON guilds_roles.guild_id = guilds.id
LEFT JOIN guilds_channels ON guilds_channels.guild_id = guilds.id
LEFT JOIN guilds_domains ON guilds_domains.guild_id = guilds.id
WHERE guilds.is_active = true
GROUP BY guilds.id, guilds.name, guilds_domains.domain
EOT;

    public function up()
    {
        $this->execute(self::VIEW_CREATION);
    }
    
    public function down()
    {
        $this->execute('DROP VIEW guilds_aggregates');
    }
    
}
