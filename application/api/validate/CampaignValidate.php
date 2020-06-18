<?php


namespace app\api\validate;


use app\common\validate\BaseValidate;

class CampaignValidate extends BaseValidate
{
    public $rule = [
        'campaignUID' => 'require|length:32'
    ];

    public $message = [
        'campaignUID' => '非法活动ID'
    ];

}