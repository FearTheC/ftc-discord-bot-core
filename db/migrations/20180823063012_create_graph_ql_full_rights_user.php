<?php

use Phinx\Migration\AbstractMigration;

class CreateGraphQlFullRightsUser extends AbstractMigration
{

    const CREATE_USER = "CREATE USER graphql_user WITH ENCRYPTED PASSWORD '22149263459181eb8b6b14b7ed9ee2b2b241b0fd0e3dd7a965d1bcc2b6368223'";

    const DROP_USER = <<<'SQL'
DROP USER graphql_user
SQL;

    const GRANT_SELECT = <<<'SQL'
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO graphql_user;
SQL;

    const REVOKE_ALL = <<<'SQL'
REVOKE ALL ON ALL TABLES IN SCHEMA public FROM graphql_user;
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
