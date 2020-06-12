<?php


namespace app\api\controller\v1;

use app\common\model\Campaign;
use app\common\model\Program as ProgramModel;
use app\common\controller\BaseController;
use think\Request;

class Program extends BaseController
{
    public function all(Request $request)
    {
        // 获取所有的项目
        $campaignID = $request->get('campaignID', 0);
        $campaign = Campaign::getOrFail($campaignID);
        $programs = ProgramModel::with(['campaign', 'product'])->all();




    }


    public function index()
    {

    }


    public function post(Request $request)
    {
    	$data = $request->param();
    	return json($data);

    }




}