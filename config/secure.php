<?php
/**
 * Created by PhpStorm.
 * User: a2
 * Date: 2020/1/3
 * Time: 21:21
 */
return [
    'access_token_salt' => 'vEu8aiCGv9SOLLET83wq1eGnSm0XZ09q',
    'access_token_expire' => (3600 * 2),
    'userinfo_expire' => (3600 * 2),
    'refresh_token_salt' => 'VrC0KkvNyYhIEMebXAJM2jXmF4JY1rZ2',
    'refresh_token_expire' => (3600 * 6),
    'auth_salt' => 'c0G41BQ$YLwH',
    'token_salt' => 'c041241B412Q$YLwH',
    'white' => [
        '/api/v1/user/info',
        '/api/v1/user/logout',
        '/api/v1/user/login/wx',
        '/api/v1/user/login/email',
        /*--------------*/
        // 接收messenger回调信息
        '/messenger',
        // 接收亚马逊验证消息的回调
        '/profile-validation',
        '/api/v1/site/reviewer',
    ],
];