<?php


use Phinx\Migration\AbstractMigration;

class CreateMessageHandlingErrorLogsTable extends AbstractMigration
{

    
    public function change()
    {
        $table = $this->table('message_handling_error_logs', $options);
        $table->addColumn('code', 'text');
        $table->addColumn('error_message', 'text');
        $table->addColumn('file', 'text');
        $table->addColumn('line', 'text');
        $table->addColumn('message', 'text');
        $table->addColumn('time', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
        
        $table->create();
    }
    
}
