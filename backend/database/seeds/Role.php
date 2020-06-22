<?php

use think\migration\Seeder;

class Role extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            ['title' => '开发'],
            ['title' => '产品'],
            ['title' => '设计'],
            ['title' => '测试'],
            ['title' => 'PMO'],
        ];
        $this->table('role')->insert($data)->save();
    }
}