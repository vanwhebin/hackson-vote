<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CampaignRatingTag extends Migrator
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
        $table = $this->table('campaign_rating_tag',array('engine'=>'MyISAM','charset' => 'utf8mb4'));
        $table -> addColumn('campaign_id', 'integer', ['limit' => 5, 'null' => false, 'signed' =>false, 'comment' => '对应campaign表的ID'])
            ->addColumn('tag_id', 'integer', ['limit' => 5, 'null' => false, 'signed' =>false, 'comment' => '对应campaign表打分权重的ID'])
            ->create();

    }
}
