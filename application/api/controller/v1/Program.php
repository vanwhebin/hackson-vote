<?php


namespace app\api\controller\v1;

use app\common\model\Campaign;
use app\common\model\Program as ProgramModel;
use app\common\controller\BaseController;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Request;
use think\response\Json;

class Program extends BaseController
{
    /**
     * @param Request $request
     * @return Json
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function all(Request $request)
    {
    }


    public function index()
    {

    }


    public function post(Request $request)
    {
    	$data = $request->param();
    	return json($data);

    }


    public function rating(Request $request)
    {
        $data = $request->param();
        $program = ProgramModel::get($data['programID']);

    }




}