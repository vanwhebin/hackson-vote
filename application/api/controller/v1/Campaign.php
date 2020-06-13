<?php


namespace app\api\controller\v1;


use app\common\controller\BaseController;
use app\common\model\Program as ProgramModel;
use app\lib\token\Token;
use think\Request;

class Campaign extends BaseController
{
    public function all()
    {

    }


    /**
     * @param Request $request
     * @return \think\response\Json
     * @throws \app\common\exception\TokenException
     * @throws \think\Exception
     */
    public function index(Request $request)
    {
        // 获取所有的项目
        // $userID = Token::getCurrentUID();
        $userID = 57;
        $campaignID = $request->get('campaignID', 1);
        \app\common\model\Campaign::getOrFail($campaignID);
        $programs = ProgramModel::getRatingProgram($campaignID, $userID);

        return resJson($programs);
    }
}