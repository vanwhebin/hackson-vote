<?php


namespace app\api\behavior;

use app\common\facade\ProgramRatingFacade;
use app\common\model\Campaign;
use app\common\model\CampaignRatingRule;

class GetCampaignRatingBehavior
{
    public function run(array $campaign)
    {
        $done =  ProgramRatingFacade::checkRecord($campaign['id']);
        if ($done) {
            // 还有没评完的
            return false;
        }
        // 如果都评完了  就需要进行统计
        // 按照对应campaign下绑定的规则
        $ruleClass = CampaignRatingRule::where(['id' => $campaign['rating_rule_id']])->value('rule');
        return call_user_func([$ruleClass, 'rating'], $campaign);
    }
}