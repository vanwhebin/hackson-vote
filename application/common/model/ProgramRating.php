<?php
/**
 * 项目评分情况详细记录
 */

namespace app\common\model;

use think\Model;
use think\model\relation\BelongsTo;

class ProgramRating extends BaseModel
{
    /**
     * 参赛项目
     * @return BelongsTo
     */
    public function program()
    {
        return $this->belongsTo('Program', 'program_id', 'id');
    }

    /**
     * 当前举办的赛事
     * @return BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo('Campaign', 'campaign_id', 'id');
    }


    /**
     * 评分人
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User', 'rating_user_id', 'id');
    }








}
