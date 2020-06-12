<?php


namespace app\api\v1\controller;

use app\common\model\Campaign;
use app\common\controller\BaseController;
use think\Request;

class Program extends BaseController
{
    public function all(Request $request)
    {
        // 获取所有的项目
        $campaignID = $request->get('campaignID', 0);
        $campaign = Campaign::getOrFail($campaignID);





    }


    public function index()
    {

    }




}