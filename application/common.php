<?php

use think\response\Json;
use think\facade\Log;

function logger($type, $log, $topic) {
    if (is_array($log)) {
        $log = json_encode($log);
    }
    Log::write($log);
    \app\common\model\Log::create([
        'type' => $type,
        'log'  => $log,
        'topic' => $topic,
    ]);
    return true;
}

/**
 * 接口返回格式化
 * @param $data
 * @param string $msg
 * @param int $errorCode
 * @return Json
 */
function resJson($data, $msg = 'ok', $errorCode = 0)
{
    $data = [
        'code' => $errorCode,
        'data' => $data,
        'msg' => $msg
    ];
    return json($data, 200);
}

// 应用公共文件
/**
 * 封装请求方法1
 * @param $url
 * @param array $params
 * @param string $method
 * @param array $header
 * @param bool $multi
 * @return mixed
 * @throws Exception
 * @throws \think\Exception
 */
function curlHttp($url, $params = [], $method = 'GET', $header = [], $multi = false)
{
    $opts = [
        CURLOPT_TIMEOUT => 60,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER => $header
    ];

    /* 根据请求类型设置特定参数 */
    switch (strtoupper($method)) {
        case 'GET':
            if ($params) {
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            } else {
                $opts[CURLOPT_URL] = $url;
            }
            break;
        case 'POST':
            //判断是否传输文件
            $params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }

    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if ($error) {
        throw new \think\Exception('请求发生错误：' . $error);
    }
    return $data;
}