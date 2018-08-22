<?php
    
use Phinx\Migration\AbstractMigration;
    
class CreateViewGuildsMembersVocalPresence extends AbstractMigration
    {
        
        const VIEW_CREATION = <<<'EOT'
CREATE VIEW view_guilds_members_vocal_presence AS
    SELECT
        vp.member_id,
        vp.channel_id,
        gc.guild_id,
        start_time,
        end_time,
        members.nickname,
        gc.name
    FROM members_vocal_presence vp
    JOIN guilds_users members ON members.user_id = vp.member_id
    JOIN guilds_channels gc ON gc.id = vp.channel_id
EOT;
        
        
    public function up()
    {
        $this->execute(self::VIEW_CREATION);
    }
    
    public function down()
    {
        $this->execute('DROP VIEW view_guilds_members_vocal_presence');
    }
    
}
    
