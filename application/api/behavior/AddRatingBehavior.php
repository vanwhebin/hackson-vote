<?php


namespace app\api\behavior;


use app\common\model\Program;
use app\common\model\ProgramRating;
use Exception;

class AddRatingBehavior
{
    /**
     * 创建新的用户评分记录
     * @param $campaign array
     * @param $user array
     * @throws Exception
     */
    public function run(array $campaign, array $user)
    {
        // 当添加项目和参赛队伍时，同时再评分表中增加对应的评分记录
        $programIDs = Program::where(['status' => Program::ACTIVE, 'campaign_id' => $campaign['id']])->column('id');
        // array_fill();
        $arr = [];
        array_map(function($item) use (&$arr, $campaign, $user){
            $arr[] = [
                'program_id' => $item,
                'campaign_id' => $campaign['id'],
                'rating_user_id' => $user['id'],
            ];
            return $item;
        }, $programIDs);
        // 批量新增
        $programRating = new ProgramRating();
        $programRating->saveAll($arr);
    }

}