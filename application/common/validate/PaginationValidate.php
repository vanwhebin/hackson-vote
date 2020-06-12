<?php


namespace app\common\validate;


class PaginationValidate extends BaseValidate
{

    protected $rule = [
        'num' => 'require|isPositiveInteger|between:1,200',
        'page' => 'require|isPositiveInteger|between:1,200',
    ];

    protected $message = [
        'num' => 'count must be a positive integer between 1 and 200',
        'page' => 'page must be a positive integer between 1 and 200',
    ];


}