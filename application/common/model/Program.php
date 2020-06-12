<?php

namespace app\common\model;

use think\Model;
use think\model\relation\BelongsTo;
use think\model\relation\HasManyThrough;

class Program extends BaseModel
{
    /**
     * 参赛项目的项目需求产品经理
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }


    /**
     * 参赛队伍
     * @return HasManyThrough
     */
    public function team()
    {
        return $this->hasManyThrough('User', 'TeamMember', 'user_id', 'team_id');
    }




}
