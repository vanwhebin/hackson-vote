<?php


namespace app\api\controller\v1;

use app\api\validate\CreateProgramValidate;
use app\api\validate\ProgramValidate;
use app\common\controller\BaseController;
use app\common\exception\InvalidParamException;
use app\common\facade\CampaignFacade as CampaignModel;
use app\common\facade\ProgramFacade as ProgramModel;
use think\Request;
use think\response\Json;

class Program extends BaseController
{

    public function create(Request $request)
    {
        // 创建一个新活动
        (new CreateProgramValidate())->validate();
    	$data = $request->param();
        $campaign = CampaignModel::findByUid($data['campaignUID']);
    	if (ProgramModel::createOne($campaign, $data, $request->user)){
    	    return resJson();
        } else {
    	    $errCode = config('error_code.program')['CREATE_FAIL'];
    	    $errMsg = config('error_msg');
            return resJson($data, $errMsg[$errCode], $errCode);
        }
    }

    /**
     * 提交评分
     * @param Request $request
     * @return Json
     * @throws InvalidParamException
     */
    public function rating(Request $request)
    {
        (new ProgramValidate())->scene('score')->validate();
        $data = $request->param();
        $campaign = CampaignModel::findByUid($data['campaignUID']);
        $program = ProgramModel::findByUid($data['programUID']);
        $user = $request->user;
        // return resJson([$campaign, $program, $user, $data]);
        $res = ProgramModel::updateRating($campaign, $program, $user, $data['score']);
        if ($res) {
            return resJson();
        } else {
            return resJson($data, '');
        }
    }




}