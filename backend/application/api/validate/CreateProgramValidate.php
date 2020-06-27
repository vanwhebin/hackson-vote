<?php


namespace app\api\validate;


use app\common\validate\BaseValidate;

class CreateProgramValidate extends BaseValidate
{
    public $rule = [
        'campaignUID' => 'require|isNotEmpty',
        'title' => 'require|isNotEmpty',
        'desc' => 'require|isNotEmpty',
        // 'team' => 'require|isNotEmpty',
        'product' => 'require|isPositiveInteger',
        'develop' => 'require',
        'test' => 'require',
        // 'rating' => 'require|isPositiveInteger',
    ];

    public $message = [
        'campaignUID' => '项目ID不可少',
        'title' => '标题不可少',
        'desc' => '请提供项目描述',
        // 'team' => '请提供团队成员',
        'product' => '请提供项目发起人',
        'develop' => '请提供项目开发',
        // 'rating' => '请提供项目评分人员',
    ];

}