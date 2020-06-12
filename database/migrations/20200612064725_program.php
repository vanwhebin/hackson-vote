<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Program extends Migrator
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
        $table = $this->table('program',array('engine'=>'InnoDB','charset' => 'utf8mb4'));
        $table->addColumn('title', 'string', ['limit' => 255, 'default' => '', 'comment' => '项目名称'])
            ->addColumn('desc', 'string', ['limit' => 255, 'default' => '', 'comment' => '项目名称'])
            ->addColumn('selected', 'integer', ['limit' => 1, 'signed' => false, 'default' => 0, 'comment' => '是否已认领'])
            ->addColumn('memo', 'string', ['limit' => 300, 'default' => '', 'comment' => '备注（需求链接之类的）'])
            ->addColumn('user_id', 'integer', ['limit' => 3, 'signed' => 'false', 'comment' => '发起人ID，对应user表外键'])
            ->addColumn('team_id', 'integer', ['limit' => 5, 'signed' => false, 'comment' => '所在队伍ID'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'signed' => false,'null'=> true,  'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'signed' => false, 'null'=> true, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 11, 'signed' => false,'null'=> true,  'comment' => '删除时间'])
            ->create();
    }
}
