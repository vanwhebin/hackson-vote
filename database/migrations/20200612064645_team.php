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
        $table->addColumn('captain_id', 'integer', ['signed' => false, 'limit'=> 5, 'null' => false, 'comment' => '队长ID'])
            ->addColumn('show_user_id', 'integer', ['signed' => false, 'limit'=> 5, 'null' => false, 'comment' => '展示人员ID'])
            ->addColumn('rating_user_id', 'integer', ['signed' => false, 'limit'=> 5, 'null' => false, 'comment' => '评分人员ID'])
            ->addColumn('title','string',['limit'=> 255, 'default' => '', 'comment' => '队名，由日期和项目名称组成'] )
            ->addColumn('order', 'integer', ['signed' => false, 'limit' => 3, 'default' => 0, 'comment' => '排序'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'signed' => false,'null'=> true,  'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'signed' => false, 'null'=> true, 'comment' => '更新时间'])
            ->addColumn('delete_time', 'integer', ['limit' => 11, 'signed' => false,'null'=> true,  'comment' => '删除时间'])
            ->create();

    }
}
