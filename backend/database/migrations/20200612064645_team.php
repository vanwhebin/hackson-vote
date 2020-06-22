<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Team extends Migrator
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
        // 组长  演示  名称  排序 评分人员
        $table = $this->table('team',array('engine'=>'InnoDB','charset' => 'utf8mb4'));
        $table->addColumn('captain', 'integer', ['signed' => false, 'limit'=> 5,'comment' => '队长ID'])
            ->addColumn('rating', 'integer', ['signed' => false, 'limit'=> 5, 'null' => false, 'comment' => '评分人员ID'])
            ->addColumn('product', 'integer', ['signed' => false, 'limit'=> 5, 'null' => false, 'comment' => '产品人员ID'])
            ->addColumn('test', 'integer', ['signed' => false, 'limit'=> 5, 'null' => false, 'comment' => '测试人员ID'])
            ->addColumn('develop', 'string', ['limit'=> 255, 'null' => false, 'comment' => '开发人员ID字符串'])
            ->addColumn('title','string',['limit'=> 255, 'default' => '', 'comment' => '队名'] )
            ->addColumn('order', 'integer', ['signed' => false, 'limit' => 3, 'default' => 0, 'comment' => '排序'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'signed' => false,'null'=> true,  'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'signed' => false, 'null'=> true, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 11, 'signed' => false,'null'=> true,  'comment' => '删除时间'])
            ->create();

    }
}
