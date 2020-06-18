<?php


namespace app\api\validate;


use app\common\validate\BaseValidate;

class ProgramValidate extends BaseValidate
{
    public $rule = [
        'ProgramUID' => 'require|length:32'
    ];

    public $message = [
        'ProgramUID' => '非法项目ID'
    ];

    public function sceneScore()
    {
        return $this->append('score', 'require|number|min:1|max:10');
    }


}