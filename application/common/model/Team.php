<?php

namespace app\common\model;

use think\Model;

class Team extends BaseModel
{
    public function captain()
    {
        return $this->belongsTo('User', 'captain_id', 'id');
    }

    public function presentation()
    {
        return $this->belongsTo('User', 'show_user_id', 'id');
    }

    public function rating()
    {
        return $this->belongsTo('User', 'rating_user_id', 'id');
    }

}
