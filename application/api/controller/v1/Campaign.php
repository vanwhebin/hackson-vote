<?php


namespace app\api\controller\v1;


use app\api\validate\CampaignValidate;
use app\common\controller\BaseController;
use app\common\exception\InvalidParamException;
use app\common\facade\ProgramFacade as ProgramModel;
use app\common\facade\CampaignFacade as CampaignModel;
use app\common\facade\ProgramRatingFacade as ProgramRatingModel;
use app\common\validate\PaginationValidate;
use think\facade\Hook;
use think\Request;
use think\response\Json;

class Campaign extends BaseController
{
    public function collections(Request $request)
    {
        // 获取活动列表信息
        (new PaginationValidate())->validate();
        $data = $request->param();
        $campaigns = CampaignModel::getList($data['pageSize'], $data['pageNum'])->toArray();
        return resJson($campaigns);
    }


    /**
     * 当前活动的细节
     * @param Request $request
     * @return Json
     * @throws InvalidParamException
     */
    public function index(Request $request)
    {
        // 获取所有的项目
        (new CampaignValidate())->validate();
        $user = $request->user;
        $userID = 57;
        $campaignUID = $request->param('campaignUID', 0);
        // return $campaignID;
        $campaign = CampaignModel::findByUid($campaignUID);
        $programs = ProgramModel::getRatingProgram($campaign->id, $userID);

        return resJson($programs);
    }

    /**
     * 用戶全部完成提交,不再修改
     * @param Request $request
     * @return Json
     * @throws InvalidParamException
     */
    public function batchSubmit(Request $request)
    {
        // 检查当前用户需要评分的项目记录，是否都已经有了评分，如果没有，则进行反馈
        // 为真 直接返回
        (new CampaignValidate())->validate();
        $data = $request->param();
        $user = $request->user;
        $campaign = CampaignModel::findByUid($data['campaignUID']);
        ProgramRatingModel::disableStatus($campaign,$user);
        $allDone = ProgramRatingModel::checkRecord($campaign->id);
        if (!$allDone) {
            Hook::exec('app\\api\\behavior\\GetCampaignRatingBehavior', $data['campaignUID']);
        }
        return resJson();
    }

    /**
     * 获取排行结果
     * @param Request $request
     * @return Json
     * @throws InvalidParamException
     */
    public function top(Request $request)
    {
        (new CampaignValidate())->validate();
        $data = $request->param();
        $campaign = CampaignModel::findByUid($data['campaignUID']);
        $programRanking = ProgramModel::getRankedResults($campaign->id)->toArray();

        return resJson($programRanking);
    }

    /**
     * 获取评分人员
     * @param Request $request
     * @return Json
     * @throws InvalidParamException
     */
    public function rater(Request $request)
    {
        (new CampaignValidate())->validate();
        $data = $request->param();
        $campaign = CampaignModel::findByUid($data['campaignUID']);
        $raters = $campaign->getRaters($campaign->rule, $campaign->id);
        return resJson($raters);
    }


    /**
     * 查找当前最新的的活动信息
     * @param Request $request
     * @return Json
     */
    public function latest(Request $request)
    {
        $campaign = CampaignModel::findLatest();
        if ($campaign) {
            return resJson($campaign);
        } else {
            $code = config('error_code.campaign')['EMPTY'];
            $msg = config('error_msg');
            return resJson($request->param(), $msg[$code], $code);
        }
    }



}