<?php


use Phinx\Migration\AbstractMigration;

class UpdateGuildsDomains extends AbstractMigration
{
    
    const DROP_NOT_NULL = 'ALTER TABLE guilds_domains ALTER COLUMN domain DROP NOT NULL';
    const SET_NOT_NULL = 'ALTER TABLE guilds_domains ALTER COLUMN domain SET NOT NULL';
    
    const SET_UNIQUE = 'ALTER TABLE guilds_domains ADD CONSTRAINT uk_guilds_domains_domains UNIQUE (domain)';
    const DROP_UNIQUE = 'ALTER TABLE guilds_domains DROP CONSTRAINT';
    
    const SET_DEFAULT_TO_FALSE = 'ALTER TABLE ONLY guilds_domains ALTER COLUMN is_active SET DEFAULT false';
    const SET_DEFAULT_TO_TRUE = 'ALTER TABLE ONLY guilds_domains ALTER COLUMN is_active SET DEFAULT true';
    
    public function up()
    {
        $this->execute(self::DROP_NOT_NULL);
        $this->execute(self::SET_UNIQUE);
        $this->execute(self::SET_DEFAULT_TO_FALSE);
    }
    
    
    public function down()
    {
        $this->execute(self::SET_DEFAULT_TO_TRUE);
        $this->execute(self::DROP_UNIQUE);
        $this->execute(self::SET_NOT_NULL);
    }
    
}
