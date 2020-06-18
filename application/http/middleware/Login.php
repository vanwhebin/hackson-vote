<?php

namespace app\http\middleware;

use app\common\exception\ForbiddenException;
use app\common\exception\TokenException;
use app\common\model\User;
use app\lib\token\Token;
use Closure;
use think\Exception;

class Login
{
    /**
     * 判断用户登录
     * @param $request
     * @param Closure $next
     * @return bool|mixed
     * @throws ForbiddenException
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        try {
            // $userInfo = Token::getCurrentUserInfo();
            // $userInfo = Token::getCurrentUserInfo();
            $userInfo = User::find(57)->toArray();

            $request->user = $userInfo;
            return $next($request);
        } catch (TokenException $exception) {
            throw new ForbiddenException(['msg' => '请先登录']);
        }
    }
}
