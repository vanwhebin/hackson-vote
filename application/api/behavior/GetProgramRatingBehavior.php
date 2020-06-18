<?php


namespace app\api\behavior;

use app\common\facade\ProgramRatingFacade;

class GetProgramRatingBehavior
{
    public function run(array $campaign, array $program)
    {
        // 当用户提交当前项目是否已全部评分，去统计是否改项目下所有评分都已结束，进入统计最后结果状态
        $done = ProgramRatingFacade::checkProgramRecord($campaign['id'], $program['id']);
        if ($done) {
            // 当前项目下
        }
    }
}