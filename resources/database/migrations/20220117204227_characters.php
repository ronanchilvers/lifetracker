<?php

use App\Model\Character;
use Phinx\Migration\AbstractMigration;

class Characters extends AbstractMigration
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
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table(Character::table(),[
            'id' => Character::primaryKey()
        ]);
        $table
            ->addColumn(Character::prefix('name'), 'string', [
                'length' => 1024, 
                'null' => false,
            ])
            ->addColumn(Character::prefix('str'), 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn(Character::prefix('dex'), 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn(Character::prefix('con'), 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn(Character::prefix('int'), 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn(Character::prefix('wis'), 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn(Character::prefix('cha'), 'integer', [
                'null' => true,
                'default' => null,
            ])
            ->addColumn(Character::prefix('notes'), 'string', [
                'length' => 4096,
                'null' => true,
            ])
            ->addTimestamps(
                Character::prefix('created'),
                Character::prefix('updated')
            )
            ->create();
    }
}
