<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Role extends Migrator
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
        $table = $this->table('role',array('engine'=>'MyISAM','charset' => 'utf8mb4'));
        $table->addColumn('title', 'string', array('limit' => 255, 'default'=> '','comment'=>'图片路径'))
            ->addColumn('status', 'integer', array('limit' => 1, 'default' => 1, 'comment' => '状态'));
        $table->create();
    }
}
