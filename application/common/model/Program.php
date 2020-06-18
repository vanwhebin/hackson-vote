<?php

namespace app\common\model;

use PDOStatement;
use think\Collection;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\exception\DbException;
use think\Model;
use think\model\relation\BelongsTo;
use think\model\relation\HasManyThrough;

class Program extends BaseModel
{
    const ACTIVE = 1;
    const INACTIVE = 0;

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
            ->where(['campaign_id' => $campaignID])
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
    public function getRatingProgram($campaignID, $userID)
    {
        $programs = self::getAllPrograms($campaignID)->toArray();
        $programsRatings = self::getRating($campaignID, $userID)->toArray();
        $times = 0;
        $programs = array_map(function(&$item) use ($programsRatings, &$times) {
            foreach($programsRatings as $rating) {
                if ($rating['program_id'] == $item['id']) {
                    $item['self_rating'] = $rating['score'];
                    $item['rating_status'] = $rating['status'];
                    if ($rating['score']) {
                        $times++;
                    }
                }
            }

            unset($item['id']);
            return $item;
        }, $programs);
        if (count($programs) == $times) {
            return ['status' => 1, 'programs' => $programs,];
        } else {
            return ['status' => 0, 'programs' => $programs,];
        }
    }


    /**
     * 通过uuid查找对应的program项目
     * @param $programUID
     * @return array|PDOStatement|string|Model
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function findByUid($programUID)
    {
        return $this->where(['uuid' => $programUID, 'status' => self::ACTIVE])->findOrFail();
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
            'rating_user_id' => $user['id'],
        ];
        $rating = new ProgramRating();
        $record = $rating->where($where)->find();
        if (!$record) {
            // return $rating->insert(array_merge($where, ['score' => $score]));
            return false;
        } else {
            $record->score = $score;
            return $record->save();
        }
        // if (is_string($score)) {
        //     $rating->rating_str = $score;
        //     $ratingResult = json_decode($score, true);
        //     foreach ($ratingResult as $val) {
        //
        //     }
        // }
    }


    /**
     * @param $campaignID
     * @return array|PDOStatement|string|Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getRankedResults($campaignID)
    {
        // 获取所有项目的排名结果
        $ranks = $this->where(['status' => self::ACTIVE, 'campaign_id' => $campaignID])
            ->field(['id', 'title', 'campaign_id', 'rating'])
            ->visible(['title', 'rating'])
            ->order('rating', 'DESC')
            ->limit(0,8)
            ->select()->each(function($item){
            $item->rating = $item->rating / 100;
            return $item;
        });
        return $ranks;

    }

    /**
     * 创建项目记录
     * @param $campaign
     * @param $data
     * @param $user
     * @return Program|bool
     */
    public function createOne($campaign, $data, $user)
    {
        Db::startTrans();
        try{
            $program = self::create([
                'title' => trim($data['title']),
                'desc' => trim($data['desc']),
                'campaign_id' => $campaign->id,
                'user_id' => $user['id'],
                'memo' => !empty($data['memo'])? trim($data['memo']) : '',
            ]);
            $team = Team::createOne($data);
            $program->uuid = createUID($campaign->id, config('secure.program_salt'));
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





}
