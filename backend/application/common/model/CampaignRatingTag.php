<?php

namespace app\common\model;

use think\Model;

class CampaignRatingTag extends BaseModel
{
    public function campaign()
    {
        return $this->belongsTo('Campaign', 'campaign_id', 'id');
    }
}
