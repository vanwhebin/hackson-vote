<?php


namespace app\api\validate;


use app\common\validate\BaseValidate;

class LoginFormValidate extends BaseValidate
{
    public $rule = [
        'username' => 'require|isNotEmpty|email',
        'password' => 'require|isNotEmpty',
    ] ;

    public $message = [
        'username' => 'correct username is required',
        'password' => 'correct password is required'
    ];

}