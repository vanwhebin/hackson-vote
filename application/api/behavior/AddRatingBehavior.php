<?php


namespace app\api\behavior;


use app\common\model\Program;
use app\common\model\ProgramRating;
use Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class AddRatingBehavior
{
    /**
     * 创建新的用户评分记录
     * @param array $campaign
     * @param array $user
     * @return bool
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function run(array $campaign, array $user)
    {
        // 当添加项目和参赛队伍时，同时再评分表中增加对应的评分记录
        $programRating = new ProgramRating();
        $existed = $programRating->where(['rating_user_id' => $user['id'], 'campaign_id' => $campaign['id']])->find();
        if($existed) {
           return false;
        }
        $where = [
            'status' => Program::ACTIVE,
            'campaign_id' => $campaign['id']
        ];
        $programIDs = Program::where($where)->column('id');
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
        $programRating->saveAll($arr);
        return true;
    }
}