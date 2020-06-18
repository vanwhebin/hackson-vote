<?php

namespace app\common\model;

use PDOStatement;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\model\relation\BelongsTo;
use think\model\relation\HasManyThrough;
use think\Paginator;

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

    /**
     * 通过uuid查找到对应的campaign记录
     * @param $campaignID
     * @return array|PDOStatement|string|Model
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function findByUid($campaignID)
    {
        return $this->where(['uuid' => $campaignID])->findOrFail();
    }

    /**
     * 活动列表
     * @param int $pageSize
     * @param int $pageNum
     * @return Paginator
     * @throws DbException
     */
    public function getList($pageSize=10, $pageNum=1)
    {
        return $this->order('id', 'DESC')->paginate($pageSize, false, ['page' => $pageNum]);
    }



    public function getRaters($rule, $campaignID)
    {
        // return $rule;
        $teamIDs = Program::where(['campaign_id' => $campaignID, 'status' => Program::ACTIVE])->column('team_id');
        $teamRaters = array_column(array_values(Team::getTeamInfo($teamIDs)->toArray()), 'rating');
        // return $teamRaters;
        if (!$rule->content) {
            // 获取评委， 评委来自参赛队伍表
            $raters = array_map(function($item){
                $item['weight'] = 0;
                return $item;
            },$teamRaters);
        } else {
            $existedRaters = json_decode($rule->content, true);
            $existedRaterIDs = array_keys($existedRaters);
            $raters = array_map(function($item) use ($existedRaterIDs, $existedRaters) {
                foreach ($existedRaterIDs as $r) {
                    if ($r == $item['name']) {
                        $item['weight'] = $existedRaters[$r];
                    } else {
                        $item['weight'] = 0;
                    }
                }
                return $item;
            },$teamRaters);
        }
        return $raters;
    }

    public function findLatest()
    {
        return self::where('start_time', '>', time())
            ->order('create_time', 'ASC')
            ->field(['uuid', 'title', 'desc', 'start_time', 'end_time'])
            ->find();
    }


}
