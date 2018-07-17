<?php


use Phinx\Migration\AbstractMigration;

class GuildMemberTrelloCardsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $options = [
            'id' => false,
            'primary_key' => ['user_id'],
        ];
        
        $table = $this->table('trello_members_cards_ids', $options);
        $table->addColumn('user_id', 'biginteger');
        $table->addColumn('card_id', 'text');
        $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade', 'update' => 'cascade']);
        $table->create();
    }
}
