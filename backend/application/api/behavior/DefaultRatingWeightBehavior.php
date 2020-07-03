<?php


namespace app\api\behavior;


use app\common\model\Team;

class DefaultRatingWeightBehavior
{
    public function run(object $campaign)
    {
        // 组织者没有设定评分权重，使用默认权重
        $teamRaters = array_column(array_values(Team::getTeamInfo($campaign->id)->toArray()), 'rating');
        $arr = [];
        array_map(function($item) use (&$arr, $teamRaters){
            $arr[$item['name']] = round(100 / count($teamRaters), 0);
            return $item;
        }, $teamRaters);

        $campaign->rule = json_encode($arr);
        $campaign->save();
        return $campaign;
    }
}