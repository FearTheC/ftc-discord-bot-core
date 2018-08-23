<?php

use Phinx\Migration\AbstractMigration;

class CreateGraphQlReader extends AbstractMigration
{
    
    const CREATE_USER = "CREATE USER graphql_reader WITH ENCRYPTED PASSWORD '784cdc3895dafd1f33e823a2eb5321f53458d8878b7b6e580bd4931b806b7299'";

    const DROP_USER = <<<'SQL'
DROP USER graphql_reader
SQL;

    const GRANT_SELECT = <<<'SQL'
GRANT SELECT ON ALL TABLES IN SCHEMA public TO graphql_reader;
SQL;

    const REVOKE_ALL = <<<'SQL'
REVOKE ALL ON ALL TABLES IN SCHEMA public FROM graphql_reader;
SQL;
    
    public function up()
    {
        $this->query(self::CREATE_USER);
        $this->execute(self::GRANT_SELECT);
    }
    
    
    public function down()
    {
        $this->execute(self::REVOKE_ALL);
        $this->query(self::DROP_USER);
    }
    
}
