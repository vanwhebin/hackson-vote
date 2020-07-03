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
    const ACTIVE = 1;
    const INACTIVE = 0;
    /**
     * 每次活动的评分的规则
     * @return BelongsTo
     */
    // public function rule()
    // {
    //     return $this->belongsTo('CampaignRatingRule', 'rating_rule_id', 'id');
    // }

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
    public static function findByUid($campaignID)
    {
        return self::where(['uuid' => $campaignID])->findOrFail();
    }

    /**
     * 活动列表
     * @param int $pageSize
     * @param int $pageNum
     * @return Paginator
     * @throws DbException
     */
    public static function getList($pageSize=10, $pageNum=1)
    {
        return self::order('id', 'DESC')->paginate($pageSize, false, ['page' => $pageNum]);
    }

    /**
     * 获取当前活动的评分人员数据
     * @param $rule
     * @param $campaignID
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getRaters($rule, $campaignID)
    {
        $teamIDs = Program::where(['campaign_id' => $campaignID, 'status' => Program::ACTIVE])->column('team_id');
        $teamRaters = array_column(array_values(Team::getTeamInfo($teamIDs)->toArray()), 'rating');

        if (!$rule) {
            // 获取评委， 评委来自参赛队伍表
            $raters = array_map(function($item){
                $item['weight'] = 0;
                return $item;
            },$teamRaters);

        } else {
            $existedRaters = json_decode($rule, true);
            $raters = [];
            foreach($existedRaters as $key=> $value) {
                $raters[] = [
                    'name' => $key,
                    'weight' => $value
                ];
            }
            // $raters = array_map(function(&$item){
            //
            // }, $existedRaters);
            // $existedRaterIDs = array_keys($existedRaters);
            // return [$teamRaters,$existedRaterIDs, $existedRaters];
            // $raters = array_map(function($item) use ($existedRaterIDs, $existedRaters) {
            //     foreach ($existedRaterIDs as $r) {
            //         if ($r == $item['name']) {
            //             $item['weight'] = $existedRaters[$r];
            //         } else {
            //             $item['weight'] = 0;
            //         }
            //     }
            //     return $item;
            // },$teamRaters);
        }
        return $raters;
    }

    /**
     * 查找到当前最近的活动
     * @return array|PDOStatement|string|Model|null
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function findLatest()
    {
        return self::order('create_time', 'DESC')
            ->field(['uuid', 'title', 'desc', 'start_time', 'end_time'])
            ->find();
    }

    public static function createOne($data)
    {
        // 创建活动
        $startTime = strtotime($data['date']. ' ' .$data['start_time']);
        $endTime = strtotime($data['date']. ' ' .$data['end_time']);
        return self::create([
            'title' => !empty($data['title']) ? $data['title'] : '',
            'start_time' => $startTime,
            'end_time' => $endTime,
            'desc' => !empty($data['desc']) ? htmlspecialchars($data['desc']) : ''
        ]);
    }

    /**
     * @param $campaign
     * @return mixed
     */
    public static function updateUID($campaign)
    {
        $uuid = createUID($campaign->id, config('secure.campaign_salt'));
        $campaign->uuid = $uuid;
        return $campaign->save();
    }

    /**
     * 更新活動信息
     * @param $campaign
     * @param $data
     * @return mixed
     */
    public static function updateInfo($campaign, $data)
    {
        // 更新活動信息
        $campaign->title = trim($data['title']);
        $campaign->desc = trim($data['desc']);
        $campaign->start_time = strtotime($data['date']. '' . $data['start_time']);
        $campaign->end_time = strtotime($data['date']. '' . $data['end_time']);
        return $campaign->save();
    }






}
