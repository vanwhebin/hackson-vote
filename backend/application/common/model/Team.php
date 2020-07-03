<?php

namespace app\common\model;

use PDOStatement;
use think\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;

class Team extends BaseModel
{
    public function captain()
    {
        return $this->belongsTo('User', 'captain_id', 'id');
    }

    public function rating()
    {
        return $this->belongsTo('User', 'rating', 'id');
    }

    public function product()
    {
        return $this->belongsTo('User', 'product', 'id');
    }

    public function design()
    {
        return $this->belongsTo('User', 'design', 'id');
    }

    public function test()
    {
        return $this->belongsTo('User', 'design', 'id');
    }



    /**
     * 创建团队记录
     * @param $data
     * @return Team
     */
    public static function createOne($data)
    {
        return self::create([
            'rating' => intval($data['rating']),
            'product' => intval($data['product']),
            'campaign_id' => intval($data['campaign_id']),
            'test' => intval($data['test']),
            'design' => !empty($data['design']) ? intval($data['design']) : null,
            'develop' => $data['develop'],
        ]);
    }

    /**
     * 获取团队内评委人员信息
     * @param $campaignID
     * @return array|PDOStatement|string|Collection
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public static function getTeamInfo($campaignID)
    {
       return self::with(['rating' => function($query){
            $query->field(['name', 'id']);
        }])->where(['campaign_id' => $campaignID])
           ->field(['id', 'rating'])
           ->visible(['rating'])
           ->select();
    }

}
