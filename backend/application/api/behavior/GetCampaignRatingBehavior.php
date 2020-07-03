<?php


namespace app\api\behavior;

use app\common\model\Program;
use app\common\model\ProgramRating;
use think\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class GetCampaignRatingBehavior
{
    /**
     * 生成活动评分记录
     * @param array $campaign
     * @return Collection
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function run(array $campaign)
    {
        // 按照对应campaign下绑定的规则
        $rule = json_decode($campaign['rule'], true);
        // {名字： 权重}
        // 获取所有人打分的分数
        $programModel = new Program();
        $formatedPrograms = [];
        $updateRating = [];
        $ratings = ProgramRating::getRating($campaign['id']);
        array_map(function($item) use (&$formatedPrograms) {
            if (!empty($item['program'])) {
                $formatedPrograms[$item['program']['id']][$item['user']['name']] = $item['score'];
            }
            return $item;
        }, $ratings);

        foreach($formatedPrograms as $key=>$program) {
            $rating = 0;
            foreach($rule as $username=>$weight) {
                if (isset($program[$username]) && !empty($program[$username])) {
                    $personalRating = round($program[$username] * $weight / 100, 2);
                    $rating = $rating + $personalRating;
                }
            }
            $updateRating[] = ['id' => $key, 'rating' => $rating];
        }

        return $programModel->saveAll($updateRating);

    }
}