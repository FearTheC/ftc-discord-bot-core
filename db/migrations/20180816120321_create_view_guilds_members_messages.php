<?php


use Phinx\Migration\AbstractMigration;

class CreateViewGuildsMembersMessages extends AbstractMigration
{
    
    const VIEW_CREATION = <<<'EOT'
    CREATE VIEW view_guilds_members_messages AS
        SELECT
            channels_messages.id,
            members.user_id AS author_id,
            members.guild_id,
            channels_messages.channel_id,
            COALESCE(members.nickname, (SELECT username from users where users.id = members.user_id)) AS nickname,
            channels_messages.creation_time,
            text_channels.name,
            channels_messages.content
        FROM guilds_users members
        LEFT JOIN guilds_channels text_channels ON text_channels.guild_id = members.guild_id
        LEFT JOIN channels_messages ON channels_messages.author_id = members.user_id AND channels_messages.channel_id = text_channels.id
        WHERE channels_messages.id IS NOT NULL 
        GROUP BY channels_messages.id, members.user_id, members.guild_id, members.nickname, text_channels.name, channels_messages.creation_time, channels_messages.channel_id, channels_messages.content;
EOT;

    
    public function up()
    {
        $this->execute(self::VIEW_CREATION);
    }
    
    public function down()
    {
        $this->execute('DROP VIEW view_guilds_members_messages');
    }
    
}
