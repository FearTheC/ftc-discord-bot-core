<?php


use Phinx\Migration\AbstractMigration;

class AddCommandsHelpColumn extends AbstractMigration
{
    
    public function up()
    { 
        $table = $this->table('commands');
        $table->addColumn('help_text', 'text');
        $table->update();
        $this->execute('ALTER TABLE commands ADD CONSTRAINT uc_commands_help_text UNIQUE (help_text)');
    }
    
    public function down()
    {
        $table = $this->table('commands');
        $table->removeColumn('help_text');
        $table->update();
    }
    
}
