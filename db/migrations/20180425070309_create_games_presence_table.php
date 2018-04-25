<?php


use Phinx\Migration\AbstractMigration;

class CreateGamesPresenceTable extends AbstractMigration
{
    
    public function up()
    {
//         $options = [
//             'id' => false,
//             'primary_key' => ['game_id', 'presence_id'],
//         ];
        
        $table = $this->table('game_presence', $options);
//         $table->addColumn('presence_id', 'biginteger');
        $table->addColumn('game_id', 'biginteger');
        $table->addColumn('start', 'datetime', ['timezone' => true]);
        $table->addColumn('end', 'datetime', ['timezone' => true, 'null' => true]);
        $table->create();
    }
    
    public function down()
    {
        $this->execute('DROP TABLE game_presence');
    }
    
}
