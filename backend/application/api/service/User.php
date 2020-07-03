<?php


namespace app\api\service;


use app\common\model\User as UserModel;
use app\common\exception\ForbiddenException;
use app\common\exception\InvalidParamException;
use app\lib\wx\WxMsg;
use app\lib\wx\WxUser;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\exception\DbException;
use think\Model;

class User
{

    /**
     * 回调查询用户信息
     * @param $params
     * @return array|null|PDOStatement|string|Model|static
     * @throws \Exception
     * @throws InvalidParamException
     * @throws Exception
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function getWxUser($params)
    {
        $wxUser = new WxUser();

        $wxUserID = $wxUser->getUserID($params['code']);
        // $wxUserID = 'qy01c1d4571e4a9d0028630fde21';
        // 查看用户是否存在，不存在就创建对应的用户

        return UserModel::getUserByUserID($wxUserID);
    }

}