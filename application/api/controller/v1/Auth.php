<?php

namespace app\api\controller\v1;

use app\api\validate\auth\LoginFormValidate;
use app\api\validate\auth\WxCallbackValidate;
use app\common\controller\BaseController;
use app\api\service\User as UserService;
use app\lib\enum\StatusEnum;
use app\lib\exception\InvalidParamException;
use app\lib\token\Token;
use app\lib\wx\WxUser;
use think\facade\Hook;
use think\Request;
use think\response\Json;
use think\response\Redirect;

class Auth extends BaseController
{
    public $service;

    public function initialize()
    {
        parent::initialize();
        $this->service = new UserService();
    }

    /**
     * 用户登录
     * @param Request $request
     * @return Json|Redirect
     * @throws InvalidParamException
     */
    public function login(Request $request)
    {
        // $type = strtolower($request->param('type'));
        // if ($type === 'wx') {
        //     return $this->wx($request);
        // } else if ($type === 'email') {
        //     return $this->email($request);
        // }
    }


    /**
     *  * 企业微信登录回调
     * @param Request $request
     * @return Redirect
     * @throws \app\common\exception\InvalidParamException
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function wx(Request $request)
    {
        // (new WxCallbackValidate())->scene('callback')->validate();
        $param = $request->param();
        // 拿到code获取用户信息, 创建用户, 拿到企业微信的access_token 缓存起来
        // $user = $this->service->getWxUser($param);
        $wxUser = new WxUser();

        $wxUserID = $wxUser->getUserID($param['code']);
        $user = \app\common\model\User::getUserByUserID($wxUserID);
        // Hook::exec('app\api\behavior\UserLoginBehavior', $user);
        $token = Token::getToken($user);
        $url = config('domain');
        // if (intval($user->status) !== StatusEnum::$user['active']) {
        //     $url = $url . '/user/register';
        // }
	    // 创建测评系统access_token，缓存用户的信息, 返回系统的access_token
        $url = $url . '?' . http_build_query($token);
        return redirect($url);
    }

    /**
     * 用户使用邮件登录
     * @param Request $request
     * @return Json
     * @throws InvalidParamException
     */
    public function email(Request $request)
    {
        (new LoginFormValidate())->validate();
        $data = $request->post();
        $user = $this->service->getEmailUser($data['email'], $data['password']);

        $token = Token::getToken($user);
        Hook::exec('app\api\behavior\UserLoginBehavior', $user);
        return resJson(200, $token);
    }
}
