<?php

/**
 * 评分最终结果
 */
namespace app\common\model;

use think\Model;
use think\model\relation\BelongsTo;

class ProgramResult extends BaseModel
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
}
