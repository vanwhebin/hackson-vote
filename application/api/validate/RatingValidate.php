<?php
namespace app\api\validate;

use app\common\validate\BaseValidate;

class RatingValidate extends BaseValidate
{
    public $rule = [
        'score' => 'require|number|min:1|max:10',
        'campaignID' => 'require|isNotEmpty'
    ];

    public $message = [
        'score' => 'Invalid rating score',
        'campaignID' => 'campaign ID is required'
    ];
}