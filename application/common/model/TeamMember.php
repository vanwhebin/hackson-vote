<?php

namespace app\common\model;

use think\Model;

class TeamMember extends BaseModel
{
    public function member()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }


    public function team()
    {
        return $this->belongsTo('Team', 'team_id', 'id');
    }

}
