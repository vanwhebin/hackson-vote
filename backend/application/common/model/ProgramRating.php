<?php
/**
 * 项目评分情况详细记录
 */

namespace app\common\model;

use PDOStatement;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\exception\DbException;
use think\exception\PDOException;
use think\Model;
use think\model\relation\BelongsTo;

class ProgramRating extends BaseModel
{
    const DEFAULT_SCORE = 0;
    const ENABLED = 0;  // 可以修改
    const DISABLED = 1;  // 不可以修改

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
     * @param $campaign
     * @return array|PDOStatement|string|Model|null
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public static function checkRecord($campaign)
    {
        // 评委  记录存在
        // 评委评分记录
        $raters = array_keys(json_decode($campaign->rule, true));
        $ratedUsers = self::with(['user' => function($query) {
            $query->field(['id', 'name']);
        }])->where(['campaign_id'=> $campaign->id, 'status' => self::DISABLED])
            ->where('score', '<>', self::DEFAULT_SCORE)
            ->field(['rating_user_id', 'status'])
            ->visible(['user'])
            ->select()
            ->toArray();
        $ratedUsers = array_map(function($item){
            $item = $item['user']['name'];
            return $item;
        },$ratedUsers);
        // 存不存在
        return array_diff($raters, $ratedUsers);
    }


    public static function checkProgramRecord($campaignID, $programID)
    {
        $where = [
            'campaign_id'=> $campaignID,
            'program_id' => $programID,
            'score' => self::DEFAULT_SCORE
        ];
        return  self::where($where)->find();
    }


    /**
     * 将当前评分人员的记录锁定，不允许修改
     * @param $campaign
     * @param $user
     * @return int|string
     * @throws Exception
     * @throws PDOException
     */
    public static function disableStatus($campaign, $user)
    {
        return self::where(['campaign_id' => $campaign->id, 'rating_user_id' => $user->id])
            ->update(['status' => self::DISABLED]);
    }

    /**
     * @param $campaignID
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getRating($campaignID)
    {
        // 获取对应的活动下已经全部打分的评分结果
        // 返回 [{user: {id: 11, name: 'zhang san'}, rating: 10 }]
        // 当前活动下已经全部打好分的
        $ratings = self::with(['user' => function($query){
            $query->field(['id', 'name']);
        }, 'program' => function($query) {
            $query->where(['status' => Program::ACTIVE])
                ->field(['id', 'title']);
        }])->where(['campaign_id' => $campaignID, 'status' => self::DISABLED])
            ->field(['rating_user_id', 'score', 'program_id'])
            ->visible(['score'])
            ->select()
            ->toArray();

        return $ratings;

    }











}
