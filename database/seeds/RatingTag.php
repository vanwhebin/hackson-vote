<?php

use think\migration\Seeder;

class RatingTag extends Seeder
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
            ['name' => '技术', 'weight' => 100],
            ['name' => '业务', 'weight' => 100],
        ];
        $this->table('rating_tag')->insert($data)->save();
    }
}