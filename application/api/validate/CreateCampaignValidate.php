<?php


namespace app\api\validate;


use app\common\validate\BaseValidate;

class CreateCampaignValidate extends BaseValidate
{

    public $rule =[
       'title' => 'require|isNotEmpty',
       'start_time' => 'require|isNotEmpty',
       'end_time' => 'require|isNotEmpty',
       'date' => 'require|isNotEmpty',
    ];

    public $message = [
        'title' => 'campaign title is required',
        'start_time' => 'the start time of campaign is required',
        'end_time' => 'the end time of campaign is required',
        'date' => 'the day of campaign is required',
    ];


}