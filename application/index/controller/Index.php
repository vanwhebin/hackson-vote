<?php
namespace app\index\controller;

use app\common\facade\ProgramRatingFacade;
use app\common\model\Campaign;
use app\common\model\Program;
use app\common\model\User;
use think\Exception;

class Index
{
    public function model()
    {

   	echo 'hello';
   	exit;
        $wxToken = "g8MQ00bnZZgoGHIEGS1AsSsnG_1MMpeANuUuIdF7Bua8gSl8_VNBJORo70ufASgpCpPZ6FRqpijpm-aiRUo5WHCDL330mvuvNS06hXf0y9b5IDcOBJAKjzmds0iQfgo4nY1mLYiAwzxetMLnDw3E5NFxSA2NuIhot60hLMEvepzGhK4YVdIuVQHDW8SaKCYVWrSDZh97rQ9lDOZEWHgMOQ";
        $api = "https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=%s&department_id=%s";
        $depArr = [
            355,
            346,
            21208,
            22205,
            22808,
            22809,
            22807,
            22811,
        ];

        $apiUrl = sprintf($api, $wxToken, 22811);
        try {
            $data = curlHttp($apiUrl, [], 'GET', ['Content-type'=> 'application/json']);
            // return json($data);
            if (!empty($_GET['test'])) {
                echo "<pre>";print_r(json_decode($data, true));
                exit;
            }

            $users = json_decode($data, true);
            foreach($users['userlist'] as $user) {
                if (User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'userid' => $user['userid'],
                    'thumb' => $user['avatar'],
                    'gender' => $user['gender'],
                ])){
                    echo "OK".PHP_EOL;
                }
            }
        } catch (Exception $e) {
            return json(['msg' => $e->getMessage(), 'line' => $e->getLine()]);
        }
    }

    public function uuid()
    {
        $userInfo = User::find(57)->toArray();
        var_dump($userInfo);
        exit;
        // return uuid();
        $t = [];
        for ($i = 0; $i< 12; $i++) {
            $t[] = md5(config('secure.campaign_salt'). $i);
        }
        return $t;
        // return md5('hackthon'. 1);
    }

    public function score()
    {
        $campaign = Campaign::get(1)->toArray();
        $rule = json_decode($campaign['rule'], true);
        $ratings = ProgramRatingFacade::getRating(1);
        $programModel = new Program();
        // return $rule;
        $formatedPrograms = [];
        $updateRating = [];
        array_map(function($item) use (&$formatedPrograms) {
            if (!empty($item['program'])) {
                $formatedPrograms[$item['program']['id']][$item['user']['name']] = $item['score'];
            }
            return $item;
        }, $ratings);
        // return json($formatedPrograms);
        foreach($formatedPrograms as $key=>$program) {
            $rating = 0;
            foreach($rule as $username=>$weight) {
                if (isset($program[$username]) && !empty($program[$username])) {
                    $personalRating = $program[$username] * $weight;
                    $rating = $rating + $personalRating;
                }
            }
            $updateRating[] = ['id' => $key, 'rating' => $rating];
        }
        // return json($updateRating);
        return $programModel->saveAll($updateRating);
    }



}
