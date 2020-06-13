<?php

namespace app\common\model;

use think\Model;
use think\model\relation\BelongsTo;
use think\model\relation\HasManyThrough;

class Program extends BaseModel
{
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


    public static function getAllPrograms($campaignID)
    {
        return self::with(['campaign' => function($query) {
            $query->field(['title', 'id'])->visible(['title']);
        } ,'product' => function($query){
            $query->field(['name', 'id'])-> visible(['name']);
        }])
            ->where(['campaign_id' => $campaignID])
            ->select();
    }

    public static function getRating($campaignID, $userID)
    {
        return ProgramRating::where(['campaign_id' => $campaignID, 'rating_user_id' => $userID])
            ->select();
    }


    public static function getRatingProgram($campaignID, $userID)
    {
        $programs = self::getAllPrograms($campaignID)->toArray();
        $programsRatings = self::getRating($campaignID, $userID)->toArray();
        return array_map(function(&$item) use ($programsRatings) {
            foreach($programsRatings as $rating) {
                $item['self_rating'] = $rating['program_id'] == $item['id'] ? $rating['rating'] : 0;
                return $item;
            }
        }, $programs);
    }







}
