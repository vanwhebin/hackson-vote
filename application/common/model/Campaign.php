<?php

namespace app\common\model;

use think\Model;
use think\model\relation\BelongsTo;
use think\model\relation\HasManyThrough;

class Campaign extends BaseModel
{
    /**
     * 每次活动的评分的规则
     * @return BelongsTo
     */
    public function rule()
    {
        return $this->belongsTo('CampaignRatingRule', 'rating_rule_id', 'id');
    }

    /**
     * 每次活动评分规则的维度
     * @return HasManyThrough
     */
    public function tag()
    {
        return $this->hasManyThrough('RatingTag', 'CampaignRatingTag', 'tag_id', 'campaign_id');
    }


}
