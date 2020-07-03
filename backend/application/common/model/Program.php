<?php

namespace app\common\model;

use PDOStatement;
use think\Collection;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\exception\DbException;
use think\facade\Hook;
use think\Model;
use think\model\relation\BelongsTo;
use think\model\relation\HasManyThrough;

class Program extends BaseModel
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    const DEFAULT_RATING = 0;

	/**
	 * 关联活动
	 * @return BelongsTo
	 */
	public function campaign()
	{
		return $this->belongsTo('Campaign', 'campaign_id','id');
	}



    /**
     * 参赛项目的项目需求产品经理
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }


    /**
     * 参赛队伍
     * @return HasManyThrough
     */
    public function team()
    {
        return $this->hasManyThrough('User', 'TeamMember', 'user_id', 'team_id');
    }


    /**
     * @param $campaignID
     * @return array|PDOStatement|string|Collection
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public static function getAllPrograms($campaignID)
    {
        return self::with(['campaign' => function($query) {
            $query->field(['title', 'id', 'uuid'])->hidden(['id']);
        } ,'product' => function($query){
            $query->field(['name', 'id'])-> visible(['name']);
        }])->visible(['title', 'desc', 'memo', 'uuid', 'id'])
            ->where(['campaign_id' => $campaignID, 'status' => Program::ACTIVE])
            ->select();
    }

    /**
     * @param $campaignID
     * @param $userID
     * @return array|PDOStatement|string|Collection
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public static function getRating($campaignID, $userID)
    {
        return ProgramRating::where(['campaign_id' => $campaignID, 'rating_user_id' => $userID])
            ->select();
    }


    /**
     * @param $campaignID
     * @param $userID
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getRatingProgram($campaignID, $userID)
    {
        $programs = self::getAllPrograms($campaignID)->toArray();
        $programsRatings = self::getRating($campaignID, $userID)->toArray();
        $status = ProgramRating::where(['status' => ProgramRating::DISABLED, 'campaign_id' => $campaignID, 'rating_user_id' => $userID])
            ->value('status');
        $programs = array_map(function(&$item) use ($programsRatings) {
            foreach($programsRatings as $rating) {
                if ($rating['program_id'] == $item['id']) {
                    $item['self_rating'] = $rating['score'];
                    $item['rating_status'] = $rating['status'];
                }
            }
            unset($item['id']);
            return $item;
        }, $programs);

        return ['status' => $status === 1 ? 1 : 0, 'programs' => $programs,];
    }


    /**
     * 通过uuid查找对应的program项目
     * @param $programUID
     * @return array|PDOStatement|string|Model
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function findByUid($programUID)
    {
        return self::where(['uuid' => $programUID, 'status' => self::ACTIVE])->findOrFail();
    }


    /**
     * @param $campaign
     * @param $program
     * @param $user
     * @param $score
     * @return bool|int|string
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function updateRating($campaign, $program, $user, $score)
    {
        // 给项目打分
        $where = [
            'program_id' => $program->id,
            'campaign_id' => $campaign->id,
            'rating_user_id' => $user->id,
        ];
        if (!$campaign->rule) {
            // 生成默认的评分规则
            $campaign = Hook::exec('app\\api\\behavior\\DefaultRatingWeightBehavior', $campaign);
        }
        $raters = array_keys(json_decode($campaign->rule, true));
        $rating = new ProgramRating();
        if (!in_array($user->name, $raters)) {
            logger('评分失败,非评委', json_encode([$raters, $user]), __CLASS__. "##". __METHOD__);
            return false;
        } else {
            $ratingRecord = $rating->where($where)->find();
            if (!$ratingRecord) {
                $params =  ['campaign' => $campaign, 'rating' => $user->id];
                Hook::exec('app\\api\\behavior\\AddRatingBehavior', $params);
                $ratingRecord = $rating->where($where)->find();
            }
            $ratingRecord->score = $score;
            return $ratingRecord->save();
        }
        // TODO 当有多维度
    }


    /**
     * @param $campaignID
     * @return array|PDOStatement|string|Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getRankedResults($campaignID)
    {
        // 获取所有项目的排名结果
        return self::where(['status' => self::ACTIVE, 'campaign_id' => $campaignID])
            ->field(['id', 'title', 'campaign_id', 'rating'])
            ->visible(['title', 'rating'])
            ->order('rating', 'DESC')
            ->limit(0,8)
            ->select()->each(function($item) {
                $item->rating = round($item->rating / 100, 2);
                return $item;
            });
    }

    /**
     * 创建项目记录
     * @param $campaign
     * @param $data
     * @param $user
     * @return Program|bool
     */
    public static function createOne($campaign, $data, $user)
    {
        Db::startTrans();
        try{
            $program = self::create([
                'title' => trim($data['title']),
                'desc' => trim($data['desc']),
                'campaign_id' => $campaign->id,
                'user_id' => $user->id,
                'memo' => !empty($data['memo'])? trim($data['memo']) : '',
            ]);
            $team = Team::createOne(array_merge($data, ['campaign_id' => intval($campaign->id)]));
            $program->uuid = createUID($program->id, config('secure.program_salt'));
            $program->team_id = $team->id;
            $program->save();
        } catch(DbException | Exception $exception){
            Db::rollback();
            logger(get_class($exception), $exception->getMessage(), __CLASS__.'#'.__METHOD__);
            return false;
        }
        Db::commit();
        return true;
    }

    /**
     * 查找是否有未完成计算的评分项目
     * @param $campaignID
     * @return array|PDOStatement|string|Model|null
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function checkRating($campaignID)
    {
        return self::where([
            'rating' => self::DEFAULT_RATING,
            'status' => self::ACTIVE,
            'campaign_id' => $campaignID
        ])->find();
    }





}
