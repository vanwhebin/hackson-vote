<?php
/**
 * 项目评分情况详细记录
 */

namespace app\common\model;

use PDOStatement;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\model\relation\BelongsTo;

class ProgramRating extends BaseModel
{
    const DEFAULT_SCORE = 0;
    const ENABLED = 0;
    const DISABLED = 1;

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


    /**
     * 檢查是否还有未评分的项目
     * @param $campaignID
     * @return array|PDOStatement|string|Model|null
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function checkRecord($campaignID)
    {
        return  $this->where(['campaign_id'=> $campaignID, 'score' => self::DEFAULT_SCORE])->find();
    }


    public function checkProgramRecord($campaignID, $programID)
    {
        $where = [
            'campaign_id'=> $campaignID,
            'program_id' => $programID,
            'score' => self::DEFAULT_SCORE
        ];
        return  $this->where($where)->find();
    }


    /**
     * 将当前评分人员的记录锁定，不允许修改
     * @param $campaign
     * @param $user
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function disableStatus($campaign, $user)
    {
        return $this->where(['campaign_id' => $campaign->id, 'rating_user_id' => $user['id']])
            ->update(['status' => self::DISABLED]);
    }











}
